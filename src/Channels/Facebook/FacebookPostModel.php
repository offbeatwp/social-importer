<?php
namespace OffbeatWP\SocialImporter\Channels\Facebook;

use OffbeatWP\SocialImporter\Models\SocialPostModel;

class FacebookPostModel extends SocialPostModel {
    public function getEmbed()
    {
        $facebookPostId = $this->getSocialId();
        // $userId = $this->getSocialUserId();

        $facebookPostId = explode('_', $facebookPostId);
        $postId = $facebookPostId[1];

        $userId = $facebookPostId[0];

        // return '<div class="fb-post" data-href="https://www.facebook.com/' . $postId . '/posts/' . $userId . '/" data-width="500" data-show-text="true"></div>';

    }

    public function getSocialUserId() {
        return ''; //TODO
    }
}