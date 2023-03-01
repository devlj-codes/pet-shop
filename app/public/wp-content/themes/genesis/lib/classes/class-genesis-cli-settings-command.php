<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package StudioPress\Genesis
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

/**
 * Manage Genesis Framework settings via cli.
 */
class Genesis_Cli_Settings_Command {

	/**
	 * Outputs the value of a setting.
	 *
	 * ## SETTING
	 *
	 * <setting>
	 * : The key for the setting you want to get.
	 *
	 * [--option_key=<key>]
	 * : The key for the database field where the settings are stored.
	 * ---
	 * default: genesis-settings
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *  $ wp genesis setting get site_layout
	 *
	 * @subcommand get
	 *
	 * @since 2.10.0
	 *
	 * @param array $args       Positional arguments.
	 * @param array $assoc_args Stores all the arguments defined like --key=value or --flag or --no-flag.
	 */
	public function get( $args, $assoc_args ) {

		$option_key = isset( $assoc_args['option_key'] ) ? $assoc_args['option_key'] : null;

		if ( empty( $args ) ) {
			WP_CLI::error( 'Please provide a setting name.' );
		}

		$value = genesis_get_option( $args[0] );

		WP_CLI::log( $value );

	}

	/**
	 * Updates a setting value.
	 *
	 * ## SETTING
	 *
	 * <setting>
	 * : The key for the setting you want to save.
	 *
	 * <value>
	 * : The setting value you want to save
	 *
	 * [--option_key=<key>]
	 * : The key for the database field where the settings are stored.
	 * ---
	 * default: genesis-settings
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *  $ wp genesis setting update site_layout content-sidebar
	 *
	 * @subcommand update
	 *
	 * @since 2.10.0
	 *
	 * @param array $args       Positional arguments.
	 * @param array $assoc_args Stores all the arguments defined like --key=value or --flag or --no-flag.
	 */
	public function update( $args, $assoc_args ) {

		$option_key = isset( $assoc_args['option_key'] ) ? $assoc_args['option_key'] : null;

		if ( genesis_update_settings( [ $args[0] => $args[1] ], $option_key ) ) {
			WP_CLI::success( __( 'Setting saved.', 'genesis' ) );
			return;
		}

		WP_CLI::error( __( 'It appears something went wrong. Please check your command and try again.', 'genesis' ) );

	}

}
