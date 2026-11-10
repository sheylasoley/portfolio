<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

// -> Konfiguration der verschiedenen Module
Container::make('post_meta', 'Module')
    ->where('post_type', '=', 'page')
    ->add_fields([
        Field::make('complex', 'modules', 'Module')
            // -> example
            ->add_fields('example', 'Beispiel', [
                Field::make('text', 'title', 'Titel')->set_required(),
                Field::make('image', 'image', 'Bild')->set_required(),
            ])
            // -> hero_front
            ->add_fields('hero_front', 'Hero Startseite', [
                Field::make('image', 'image', 'Bild')->set_required(),
                Field::make('text', 'title', 'Titel')->set_required(),
                Field::make('text', 'subtitle', 'Untertitel'),
            ])
            // -> work
            ->add_fields('work', 'Work', [
                Field::make('text', 'title', 'Titel')->set_required(),
            ])
            // -> about
            ->add_fields('about', 'About me', [
                Field::make('text', 'title', 'Titel')->set_required(),
                Field::make('image', 'image', 'Bild')->set_required(),
                Field::make('rich_text', 'text', 'Text')->set_required(),
            ])
            // -> contact
            ->add_fields('contact', 'Contact', [
                Field::make('text', 'title', 'Titel')->set_required(),
                Field::make('textarea', 'lead', 'Lead'),
                Field::make('textarea', 'address', 'Adresse'),
                Field::make('text', 'phone', 'Mobile'),
            ])
            // todo: add new modules here
            // -> SETTINGS
            ->set_layout('tabbed-vertical')
    ]);

// -> Funktion, um die Module und die entsprechenden Templates auf der Seite zu laden
function render_modules (): void {
    $modules = carbon_get_the_post_meta('modules');
    if (empty($modules)) {
        return;
    }
    foreach ($modules as $module) {
        // -> Modifiziere die Daten des Moduls, falls nötig, basierend auf dem Modultyp
        switch ($module['_type']) {
            case 'example':
            case 'hero_front':
            case 'about':
                $module['image'] = get_media_by_id($module['image'], 'full');
                break;
            case 'work':
                $project_ids = get_posts([
                    'post_type' => 'project',
                    'numberposts' => -1,
                    'fields' => 'ids',
                ]);
                $module['projects'] = array_map(function ($id) {
                    $project = get_project_by_id($id);
                    $project['url'] = get_permalink($id);
                    return $project;
                }, $project_ids);
                break;
                // todo: add data modifications for modules here as a new case
        }
        // -> Laden des Templates basierend auf dem Modultyp und weitergeben der Daten
        get_template_part(
            'frontend/views/modules/' . $module['_type'],
            null,
            [
                'data' => $module
            ]
        );
    }
}