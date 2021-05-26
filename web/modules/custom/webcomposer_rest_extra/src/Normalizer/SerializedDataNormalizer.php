<?php

namespace Drupal\webcomposer_rest_extra\Normalizer;
use Drupal\rest_views\SerializedData;
use Drupal\Core\Language\LanguageInterface;
use Drupal\rest_views\Normalizer\DataNormalizer;
use Drupal\serialization\Normalizer\NormalizerBase;
use Drupal\webcomposer_rest_extra\ExposedFiltersTrait;

/**
 * Unwrap a SerializedData object and normalize the data inside.
 * Extended from rest_views contrib module
 *
 * @see \Drupal\rest_views\SerializedData
 */
class SerializedDataNormalizer extends DataNormalizer {
    use ExposedFiltersTrait;
    // Make sure that the views id is games_list
    // Otherwise, the exposed filters won't work
    const ALLOWED_ID = [
        'games_list'
    ];
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = NULL, array $context = []) {
        /** @var \Drupal\rest_views\SerializedData $object */
        /** @var \Symfony\Component\Serializer\Normalizer\NormalizerInterface $normalizer */
        $normalizer = $this->serializer;
        $rawData = $object->getData();
        $data = [];
        $exposedFilters = [];
        if (isset($context['views_style_plugin'])) {
            if (in_array($context['views_style_plugin']->view->storage->get('id'), self::ALLOWED_ID)) {
                $exposedFilters = $this->getExposedFilters($context['views_style_plugin']->view);
            }
        }

        if ($exposedFilters) {
            // Add exposed filters to data so the serializer can use it to
            // fetch the draggable views
            $rawData['exposed_filters'] = $exposedFilters;
        }
        return $normalizer->normalize($rawData);
    }
}