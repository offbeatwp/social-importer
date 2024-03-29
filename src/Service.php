<?php
namespace OffbeatWP\SocialImporter;

use OffbeatWP\Services\AbstractService;
use Illuminate\Support\Collection;

class Service extends AbstractService {

    public $bindings = [
        'social_importer' => SocialImporterRepository::class,
    ];

    public function register()
    {
        $this->registerPostType();
        $this->registerRoutes();

        add_filter('acf/settings/remove_wp_meta_box', function ($remove) {
            global $post;

            if (isset($post->post_type) && $post->post_type == \OffbeatWP\SocialImporter\Models\SocialPostModel::POST_TYPE)
                $remove = false;

            return $remove;
        });

        offbeat('admin-page')->makeSub('tools', __('Social Importer', 'offbeatwp'), 'social-importer', 'edit_posts', 'controller');

        offbeat('console')->register(\OffbeatWP\SocialImporter\Console\SocialImporterCommand::class);

        offbeat('ajax')->make('social_embed', Actions\SocialEmbed::class);
    }

    public function registerPostType()
    {
        offbeat('post-type')
            ->make(\OffbeatWP\SocialImporter\Models\SocialPostModel::POST_TYPE, __('Social Posts', 'offbeatwp'), __('Social Post', 'offbeatwp'))
            ->model(\OffbeatWP\SocialImporter\Models\SocialPostModel::class)
            ->supports(['title', 'editor', 'thumbnail', 'custom-fields'])
            ->notPubliclyQueryable()
            ->inMenu('misc-content')
            ->public()
            ->set();
    }

    public function registerRoutes()
    {
             offbeat('routes')->callback(
                function () {
                    return is_admin() && $_GET['page'] == 'social-importer';
                },
                [\OffbeatWP\SocialImporter\Controllers\SocialImporterController::class, 'actionConfig']
             );
    }
}
