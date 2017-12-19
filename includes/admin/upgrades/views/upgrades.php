<?php
/**
 * Upgrade Screen
 *
 * @package     Give
 * @subpackage  Admin/Upgrades
 * @copyright   Copyright (c) 2017, WordImpress
 * @license     https://opensource.org/licenses/gpl-license GNU Public License
 * @since       1.8.12
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$give_updates = Give_Updates::get_instance();
?>
<div class="wrap" id="poststuff">
	<div id="give-updates">
		<h1 id="give-updates-h1"><?php esc_html_e( 'Give - Updates', 'give' ); ?></h1>
		<hr class="wp-header-end">

		<div class="give-update-panel-content">
			<p><?php printf( __( 'Give regularly receives new features, bug fixes, and enhancements. It is important to always stay up-to-date with latest version of Give core and its add-ons.  Please create a backup of your site before updating. To update add-ons be sure your <a href="%1$s">license keys</a> are activated.', 'give' ), 'https://givewp.com/my-account/' ); ?></p>
		</div>

		<?php $db_updates = $give_updates->get_pending_db_update_count(); ?>
		<?php if ( ! empty( $db_updates ) ) : ?>
			<?php
			$is_doing_updates = $give_updates->is_doing_updates();
			$db_update_url    = add_query_arg( array( 'type' => 'database', ) );
			$resume_updates   = get_option( 'give_doing_upgrade' );
			$width            = ! empty( $resume_updates ) ? $resume_updates['percentage'] : 0;
			?>
			<div id="give-db-updates" data-resume-update="<?php echo absint( $give_updates->is_doing_updates() ); ?>">
				<div class="postbox-container">
					<div class="postbox">
						<h2 class="hndle"><?php _e( 'Database Updates', 'give' ); ?></h2>
						<div class="inside">
							<div class="panel-content">
								<p class="give-update-button">
									<?php echo sprintf(
										__( '%1$s <a href="%2$s" class"%3$s">%4$s</a>', 'give' ),
										__( 'Give needs to update the database.', 'give' ),
										$db_update_url,
										( $is_doing_updates ? '' : ' give-hidden' ),
										__( 'Update now', 'give' )
									);
									?>
								</p>
							</div>
							<div class="progress-container<?php echo $is_doing_updates ? '' : ' give-hidden'; ?>">
								<p class="update-message">
									<strong>
										<?php
										echo sprintf(
											__( 'Update %s of %s', 'give' ),
											$give_updates->get_running_db_update(),
											$give_updates->get_total_new_db_update_count()
										);
										?>
									</strong>
								</p>
								<div class="progress-content">
									<?php if ( $is_doing_updates ) : ?>
										<div class="notice-wrap give-clearfix">
											<span class="spinner is-active"></span>
											<div class="give-progress">
												<div style="width: <?php echo $width ?>%;"></div>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>

							<div class="give-run-database-update">
								<div class="notice-wrap give-clearfix">
								</div>
							</div>
						</div>
						<!-- .inside -->
					</div><!-- .postbox -->
				</div>
			</div>
		<?php endif; ?>

		<?php $plugin_updates = $give_updates->get_total_plugin_update_count(); ?>
		<?php if ( ! empty( $plugin_updates ) ) : ?>
			<?php $plugin_update_url = add_query_arg( array(
				's' => 'Give',
			), admin_url( '/plugins.php' ) ); ?>
			<div id="give-plugin-updates">
				<div class="postbox-container">
					<div class="postbox">
						<h2 class="hndle"><?php _e( 'Add-on Updates', 'give' ); ?></h2>
						<div class="inside">
							<div class="panel-content">
								<p><?php echo sprintf( __( 'There %1$s %2$s Give %3$s that %4$s to be updated. <a href="%5$s">Update now</a>', 'give' ), _n( 'is', 'are', $plugin_updates, 'give' ), $plugin_updates, _n( 'add-on', 'add-ons', $plugin_updates, 'give' ), _n( 'needs', 'need', $plugin_updates, 'give' ), $plugin_update_url ); ?></p>
								<?php include_once 'plugins-update-section.php'; ?>
							</div>
						</div>
						<!-- .inside -->
					</div><!-- .postbox -->
				</div>
			</div>
		<?php endif; ?>

	</div>
</div>