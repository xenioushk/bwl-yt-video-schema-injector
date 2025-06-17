<?php
namespace KDESKADDON\Callbacks\Filters\Admin;

/**
 * Class for registering the category sort callabck.
 *
 * @package KDESKADDON
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class AuthorSocialMetaCb {

	/**
	 * Set the author social links.
	 */
	public function set_author_social_links() {
		// Add new fields
		return [
			'facebook'  => 'Facebook URL',
			'twitter'   => 'Twitter Username',
			'linkedin'  => 'Linkedin URL',
			'instagram' => 'Instagram URL',
		];
	}
}
