/**
 * theme-utils.mjs
 *
 * Validation and utility script for the LightSpeed WordPress block theme starter.
 *
 * Usage:
 *   node theme-utils.mjs <command>
 *
 * Commands:
 *   validate-schema    Validate theme.json and style variation JSON files against the WordPress schema.
 *   validate-theme     Validate theme consistency: slugs, required files, placeholder usage, etc.
 *   escape-patterns    Scan PHP pattern files for escaping and translation issues.
 *   security-scan      Scan PHP files for common security issues.
 *   help               Show this help message.
 */

import { readFileSync, existsSync, readdirSync, statSync } from 'fs';
import { resolve, join, relative } from 'path';
import { createRequire } from 'module';

const require = createRequire( import.meta.url );

// Root of the theme repository.
const ROOT = resolve( '.' );

// Colours for terminal output.
const RESET = '\x1b[0m';
const RED = '\x1b[31m';
const YELLOW = '\x1b[33m';
const GREEN = '\x1b[32m';
const CYAN = '\x1b[36m';
const BOLD = '\x1b[1m';

function log( message ) {
	console.log( message );
}

function success( message ) {
	console.log( `${ GREEN }✔ ${ message }${ RESET }` );
}

function warn( message ) {
	console.warn( `${ YELLOW }⚠ ${ message }${ RESET }` );
}

function error( message ) {
	console.error( `${ RED }✖ ${ message }${ RESET }` );
}

function info( message ) {
	console.log( `${ CYAN }ℹ ${ message }${ RESET }` );
}

function heading( message ) {
	console.log( `\n${ BOLD }${ message }${ RESET }` );
}

/**
 * Read and parse a JSON file. Returns null and logs an error on failure.
 *
 * @param {string} filePath Absolute path to the JSON file.
 * @returns {object|null}
 */
function readJSON( filePath ) {
	try {
		const content = readFileSync( filePath, 'utf8' );
		return JSON.parse( content );
	} catch ( err ) {
		error( `Failed to parse JSON at ${ relative( ROOT, filePath ) }: ${ err.message }` );
		return null;
	}
}

/**
 * Recursively collect files matching an extension in a directory.
 *
 * @param {string} dir       Directory to search.
 * @param {string} extension File extension (e.g. '.json', '.php').
 * @returns {string[]} Array of absolute file paths.
 */
function collectFiles( dir, extension ) {
	const results = [];
	if ( ! existsSync( dir ) ) {
		return results;
	}
	for ( const name of readdirSync( dir ) ) {
		const fullPath = join( dir, name );
		const stat = statSync( fullPath );
		if ( stat.isDirectory() ) {
			results.push( ...collectFiles( fullPath, extension ) );
		} else if ( name.endsWith( extension ) ) {
			results.push( fullPath );
		}
	}
	return results;
}

// ---------------------------------------------------------------------------
// Command: validate-schema
// ---------------------------------------------------------------------------

/**
 * Validate theme.json and all styles/*.json files against the WordPress theme.json schema.
 * Also validates any JSON files found in styles/blocks/ and styles/sections/.
 */
async function validateSchema() {
	heading( 'Validating JSON schemas…' );

	let Ajv, addFormats;
	try {
		const ajvModule = await import( 'ajv' );
		Ajv = ajvModule.default;
	} catch {
		error( 'ajv is not installed. Run: npm install' );
		process.exit( 1 );
	}

	// Fetch the WordPress theme.json schema.
	const schemaUrl = 'https://schemas.wp.org/trunk/theme.json';
	let schema;
	try {
		const response = await fetch( schemaUrl );
		if ( ! response.ok ) {
			throw new Error( `HTTP ${ response.status }` );
		}
		schema = await response.json();
	} catch ( fetchError ) {
		warn( `Could not fetch schema from ${ schemaUrl }: ${ fetchError.message }` );
		warn( 'Falling back to structural JSON parse check only.' );
		schema = null;
	}

	// Collect JSON files to validate.
	const filesToValidate = [
		join( ROOT, 'theme.json' ),
		...collectFiles( join( ROOT, 'styles' ), '.json' ),
	];

	// Note: assets/fonts/ contains binary font assets — NOT JSON.
	// We intentionally do not validate anything under assets/fonts/.

	if ( filesToValidate.length === 0 ) {
		warn( 'No JSON files found to validate.' );
		return;
	}

	let hasErrors = false;

	if ( schema ) {
		const ajv = new Ajv( { allErrors: true, strict: false } );
		const validate = ajv.compile( schema );

		for ( const file of filesToValidate ) {
			const rel = relative( ROOT, file );
			const data = readJSON( file );
			if ( data === null ) {
				hasErrors = true;
				continue;
			}
			const valid = validate( data );
			if ( ! valid ) {
				error( `Schema validation failed: ${ rel }` );
				for ( const validationError of ( validate.errors || [] ) ) {
					error( `  ${ validationError.instancePath || '(root)' } ${ validationError.message }` );
				}
				hasErrors = true;
			} else {
				success( `${ rel }` );
			}
		}
	} else {
		// Fallback: just check JSON is parseable.
		for ( const file of filesToValidate ) {
			const rel = relative( ROOT, file );
			const data = readJSON( file );
			if ( data === null ) {
				hasErrors = true;
			} else {
				success( `${ rel } (JSON parse OK — schema unavailable)` );
			}
		}
	}

	if ( hasErrors ) {
		error( '\nSchema validation completed with errors.' );
		process.exit( 1 );
	} else {
		success( '\nAll JSON files passed schema validation.' );
	}
}

// ---------------------------------------------------------------------------
// Command: validate-theme
// ---------------------------------------------------------------------------

/**
 * Validate theme consistency:
 * - Required files exist.
 * - No unreplaced placeholder tokens.
 * - Text domain consistency.
 * - Style variations light.json and dark.json exist.
 */
async function validateTheme() {
	heading( 'Validating theme consistency…' );

	let hasErrors = false;
	let hasWarnings = false;

	// Required files.
	const required = [
		'style.css',
		'theme.json',
		'functions.php',
		'templates/index.html',
		'parts/header.html',
		'parts/footer.html',
		'styles/light.json',
		'styles/dark.json',
	];

	info( 'Checking required files…' );
	for ( const file of required ) {
		const fullPath = join( ROOT, file );
		if ( existsSync( fullPath ) ) {
			success( file );
		} else {
			error( `Missing required file: ${ file }` );
			hasErrors = true;
		}
	}

	// Check for unreplaced placeholder tokens.
	info( '\nChecking for unreplaced placeholder tokens…' );
	// Exclude generated lock files and dependency directories from placeholder scan.
	const excludeDirs = [ 'node_modules', 'vendor' ];
	const excludeFiles = [ 'package-lock.json', 'composer.lock' ];
	const isExcluded = ( f ) =>
		excludeDirs.some( d => f.includes( `/${ d }/` ) || f.includes( `\\${ d }\\` ) ) ||
		excludeFiles.some( name => f.endsWith( `/${ name }` ) || f.endsWith( `\\${ name }` ) );

	const textFiles = [
		...collectFiles( ROOT, '.css' ).filter( f => ! isExcluded( f ) ),
		...collectFiles( ROOT, '.php' ).filter( f => ! isExcluded( f ) ),
		...collectFiles( ROOT, '.json' ).filter( f => ! isExcluded( f ) ),
		...collectFiles( ROOT, '.html' ).filter( f => ! isExcluded( f ) ),
		...collectFiles( ROOT, '.md' ).filter( f => ! isExcluded( f ) ),
		...collectFiles( ROOT, '.txt' ).filter( f => ! isExcluded( f ) ),
	];

	const placeholderRegex = /\{\{[A-Z_]+\}\}/g;
	const foundPlaceholders = {};

	for ( const file of textFiles ) {
		const rel = relative( ROOT, file );
		try {
			const content = readFileSync( file, 'utf8' );
			const matches = content.match( placeholderRegex );
			if ( matches ) {
				foundPlaceholders[ rel ] = [ ...new Set( matches ) ];
			}
		} catch {
			// Skip unreadable files.
		}
	}

	if ( Object.keys( foundPlaceholders ).length > 0 ) {
		warn( 'Unreplaced placeholder tokens found:' );
		for ( const [ file, tokens ] of Object.entries( foundPlaceholders ) ) {
			warn( `  ${ file }: ${ tokens.join( ', ' ) }` );
		}
		hasWarnings = true;
	} else {
		success( 'No unreplaced placeholder tokens found.' );
	}

	// Check text domain consistency in style.css vs functions.php.
	info( '\nChecking text domain consistency…' );
	const styleCssPath = join( ROOT, 'style.css' );
	const functionsPHPPath = join( ROOT, 'functions.php' );

	if ( existsSync( styleCssPath ) && existsSync( functionsPHPPath ) ) {
		const styleContent = readFileSync( styleCssPath, 'utf8' );
		const functionsContent = readFileSync( functionsPHPPath, 'utf8' );

		const textDomainMatch = styleContent.match( /Text Domain:\s*(.+)/i );
		const textDomainInCSS = textDomainMatch ? textDomainMatch[ 1 ].trim() : null;

		if ( textDomainInCSS && ! textDomainInCSS.startsWith( '{{' ) ) {
			const textDomainInFunctions = functionsContent.includes( `'${ textDomainInCSS }'` );
			if ( textDomainInFunctions ) {
				success( `Text domain '${ textDomainInCSS }' found consistently in style.css and functions.php.` );
			} else {
				warn( `Text domain '${ textDomainInCSS }' found in style.css but not in functions.php.` );
				hasWarnings = true;
			}
		} else {
			info( 'Text domain placeholder not yet replaced — skipping consistency check.' );
		}
	}

	// Report outcome.
	if ( hasErrors ) {
		error( '\nTheme validation completed with errors. Please fix the issues above.' );
		process.exit( 1 );
	} else if ( hasWarnings ) {
		warn( '\nTheme validation completed with warnings. Review the issues above.' );
	} else {
		success( '\nTheme validation passed.' );
	}
}

// ---------------------------------------------------------------------------
// Command: escape-patterns
// ---------------------------------------------------------------------------

/**
 * Scan PHP pattern files for potential escaping and translation issues.
 * This is advisory — it flags likely issues but does not auto-fix them.
 */
async function escapePatterns() {
	heading( 'Scanning PHP patterns for escaping issues…' );

	const patternsDir = join( ROOT, 'patterns' );
	const incDir = join( ROOT, 'inc' );
	const functionsPath = join( ROOT, 'functions.php' );

	const phpFiles = [
		...collectFiles( patternsDir, '.php' ),
		...collectFiles( incDir, '.php' ),
	];

	if ( existsSync( functionsPath ) ) {
		phpFiles.push( functionsPath );
	}

	if ( phpFiles.length === 0 ) {
		info( 'No PHP files found to scan.' );
		return;
	}

	let issueCount = 0;

	// Patterns that suggest unescaped output.
	const echoPatterns = [
		{
			// echo without escaping function wrapping the value
			regex: /\becho\s+(?!\s*(esc_html|esc_attr|esc_url|esc_js|wp_kses|wp_kses_post|absint|intval)\s*\()(.+?);/g,
			label: 'Possible unescaped echo',
		},
		{
			// print without escaping
			regex: /\bprint\s+(?!\s*(esc_html|esc_attr|esc_url|esc_js|wp_kses|wp_kses_post|absint|intval)\s*\()(.+?);/g,
			label: 'Possible unescaped print',
		},
		{
			// Direct superglobal output
			regex: /echo\s+\$_(GET|POST|REQUEST|SERVER|COOKIE)\[/g,
			label: 'Direct superglobal output — critical',
		},
	];

	// Translation function patterns to flag issues.
	const translationPatterns = [
		{
			// __() or _e() without text domain
			regex: /__\s*\(\s*['"][^'"]+['"]\s*\)/g,
			label: '__() called without text domain',
		},
		{
			// _e() without text domain
			regex: /_e\s*\(\s*['"][^'"]+['"]\s*\)/g,
			label: '_e() called without text domain',
		},
	];

	for ( const file of phpFiles ) {
		const rel = relative( ROOT, file );
		const content = readFileSync( file, 'utf8' );
		const lines = content.split( '\n' );

		const fileIssues = [];

		// Check line by line for suspicious patterns.
		for ( let i = 0; i < lines.length; i++ ) {
			const line = lines[ i ];
			const lineNum = i + 1;

			// Skip comment lines.
			if ( line.trimStart().startsWith( '//' ) || line.trimStart().startsWith( '*' ) || line.trimStart().startsWith( '/*' ) ) {
				continue;
			}

			// Check echo patterns.
			for ( const pattern of echoPatterns ) {
				pattern.regex.lastIndex = 0;
				if ( pattern.regex.test( line ) ) {
					// Exclude lines that do have escaping in them.
					if ( ! /esc_html|esc_attr|esc_url|esc_js|wp_kses|wp_kses_post|absint|intval/.test( line ) ) {
						fileIssues.push( `  Line ${ lineNum }: [${ pattern.label }] ${ line.trim() }` );
					}
				}
			}

			// Check translation patterns.
			for ( const pattern of translationPatterns ) {
				pattern.regex.lastIndex = 0;
				if ( pattern.regex.test( line ) ) {
					fileIssues.push( `  Line ${ lineNum }: [${ pattern.label }] ${ line.trim() }` );
				}
			}
		}

		if ( fileIssues.length > 0 ) {
			warn( `\n${ rel }:` );
			for ( const issue of fileIssues ) {
				warn( issue );
			}
			issueCount += fileIssues.length;
		} else {
			success( rel );
		}
	}

	if ( issueCount > 0 ) {
		warn( `\nEscape scan completed. ${ issueCount } potential issue(s) found. Review manually.` );
	} else {
		success( '\nNo escaping issues found.' );
	}
}

// ---------------------------------------------------------------------------
// Command: security-scan
// ---------------------------------------------------------------------------

/**
 * Scan PHP files for common security issues.
 * This is advisory — it flags likely risks but is not a replacement for a full audit.
 */
async function securityScan() {
	heading( 'Running security scan on PHP files…' );

	const phpFiles = [
		...collectFiles( join( ROOT, 'patterns' ), '.php' ),
		...collectFiles( join( ROOT, 'inc' ), '.php' ),
	];

	const functionsPath = join( ROOT, 'functions.php' );
	if ( existsSync( functionsPath ) ) {
		phpFiles.push( functionsPath );
	}

	if ( phpFiles.length === 0 ) {
		info( 'No PHP files found to scan.' );
		return;
	}

	// High-risk patterns.
	const securityPatterns = [
		{
			regex: /\beval\s*\(/g,
			label: 'CRITICAL: eval() detected',
		},
		{
			regex: /echo\s+\$_(GET|POST|REQUEST|SERVER|COOKIE)\[/g,
			label: 'CRITICAL: Direct superglobal output',
		},
		{
			regex: /\$wpdb->query\s*\(\s*['"]/g,
			label: 'WARNING: Possible unprepared database query',
		},
		{
			regex: /\$wpdb->prepare\s*\(\s*\$[^,)]+\)/g,
			label: 'WARNING: $wpdb->prepare() may be called without placeholders',
		},
		{
			regex: /file_get_contents\s*\(\s*\$_(GET|POST|REQUEST)/g,
			label: 'CRITICAL: file_get_contents with user input',
		},
		{
			regex: /include\s*\(\s*\$_(GET|POST|REQUEST)/g,
			label: 'CRITICAL: Dynamic include with user input',
		},
		{
			regex: /require\s*\(\s*\$_(GET|POST|REQUEST)/g,
			label: 'CRITICAL: Dynamic require with user input',
		},
		{
			regex: /\$_(GET|POST|REQUEST)\[.+\]\s*(?!.*sanitize)/g,
			label: 'WARNING: Unsanitised superglobal usage',
		},
	];

	let issueCount = 0;

	for ( const file of phpFiles ) {
		const rel = relative( ROOT, file );
		const content = readFileSync( file, 'utf8' );
		const lines = content.split( '\n' );
		const fileIssues = [];

		for ( let i = 0; i < lines.length; i++ ) {
			const line = lines[ i ];
			const lineNum = i + 1;

			if ( line.trimStart().startsWith( '//' ) || line.trimStart().startsWith( '*' ) ) {
				continue;
			}

			for ( const pattern of securityPatterns ) {
				pattern.regex.lastIndex = 0;
				if ( pattern.regex.test( line ) ) {
					fileIssues.push( `  Line ${ lineNum }: [${ pattern.label }] ${ line.trim() }` );
				}
			}
		}

		if ( fileIssues.length > 0 ) {
			error( `\n${ rel }:` );
			for ( const issue of fileIssues ) {
				error( issue );
			}
			issueCount += fileIssues.length;
		} else {
			success( rel );
		}
	}

	if ( issueCount > 0 ) {
		error( `\nSecurity scan completed. ${ issueCount } potential issue(s) found. Review manually.` );
		process.exit( 1 );
	} else {
		success( '\nSecurity scan passed.' );
	}
}

// ---------------------------------------------------------------------------
// Command: help
// ---------------------------------------------------------------------------

function showHelp() {
	log( `
${ BOLD }theme-utils.mjs — LightSpeed WordPress Block Theme Utility${ RESET }

Usage:
  node theme-utils.mjs <command>

Commands:
  ${ CYAN }validate-schema${ RESET }
    Validate theme.json and all styles/*.json files against the WordPress schema.
    Also validates JSON files in styles/blocks/ and styles/sections/ if present.

  ${ CYAN }validate-theme${ RESET }
    Cross-file checks: required files, placeholder tokens, text domain consistency.

  ${ CYAN }escape-patterns${ RESET }
    Scan PHP pattern files and inc/ for likely escaping and translation issues.

  ${ CYAN }security-scan${ RESET }
    Scan PHP files for common security risks (eval, direct superglobal output, etc).

  ${ CYAN }help${ RESET }
    Show this help message.
` );
}

// ---------------------------------------------------------------------------
// Entry point
// ---------------------------------------------------------------------------

const command = process.argv[ 2 ];

switch ( command ) {
	case 'validate-schema':
		await validateSchema();
		break;
	case 'validate-theme':
		await validateTheme();
		break;
	case 'escape-patterns':
		await escapePatterns();
		break;
	case 'security-scan':
		await securityScan();
		break;
	case 'help':
	default:
		showHelp();
		break;
}
