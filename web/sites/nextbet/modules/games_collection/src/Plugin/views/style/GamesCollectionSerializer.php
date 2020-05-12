<?php

namespace Drupal\games_collection\Plugin\views\style;

use Drupal\rest\Plugin\views\style\Serializer;
use Drupal\webcomposer_rest_extra\PagerTrait;

/**
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "games_collection_serializer",
 *   title = @Translation("Games Collection Serializer"),
 *   help = @Translation("Custom serializer for the games collection entities"),
 *   display_types = {"data"}
 * )
 */
class GamesCollectionSerializer extends Serializer
{
    /**
     * {@inheritdoc}
     */
    public function render()
    {
        // $typeKey = $type['field_type'][0]['name'][0]['value'] ?? null;
        //     $games = $type['field_games'] ?? [];
        //     $category = $type['field_game_category'][0]['tid'][0]['value'] ?? '0';
        $rows = [];
        $fields = array_column($this->view->field, 'field');
        // \Kint::dump($fields);
        foreach ($this->view->result as $row_index => $row) {
            $this->view->row_index = $row_index;
            
            $row_render = $this->view->rowPlugin->render($row);
            $temp = [
                'id' => $row_render->id->value,
            ];
            foreach ($fields as $fieldName) {
                $fieldData = $row_render->{$fieldName};
                $fieldType = $fieldData->getFieldDefinition()->getType();
                switch ($fieldType) {
                    case 'string':
                        $temp[$fieldName] = $fieldData->value;
                        break;
                    case 'entity_reference':
                        // \Kint::dump($fieldData);
                        $temp[$fieldName] = 'test';
                        break;
                }
            }

            array_push($rows, $temp);
        }
        unset($this->view->row_index);
        // \Kint::dump($rows);

        // Get the content type configured in the display or fallback to the
        // default.
        if ((empty($this->view->live_preview))) {
            $content_type = $this->displayHandler->getContentType();
        } else {
            $content_type = !empty($this->options['formats']) ? reset($this->options['formats']) : 'json';
        }
        return $this->serializer->serialize($rows, $content_type, ['views_style_plugin' => $this]);
    }
}
