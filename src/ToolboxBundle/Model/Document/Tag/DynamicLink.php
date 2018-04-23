<?php

namespace ToolboxBundle\Model\Document\Tag;

use Pimcore\Model;
use Symfony\Component\EventDispatcher\GenericEvent;

class DynamicLink extends Model\Document\Tag\Link
{
    /**
     * Return the type of the element
     *
     * @return string
     */
    public function getType()
    {
        return 'dynamiclink';
    }

    /**
     * @return string
     */
    public function getHref()
    {
        $url = $this->data['path'];

        if (strpos($url, '::') === false) {
            return parent::getHref();
        }

        $objectInfo = explode('::', $url);
        if (count($objectInfo) !== 2) {
            return parent::getHref();
        }

        if (!\Pimcore\Tool::isFrontend()) {
            return parent::getHref();
        }

        $event = new GenericEvent($this, [
            'className'         => $objectInfo[0],
            'path'              => $objectInfo[1],
            'objectFrontendUrl' => $url
        ]);

        \Pimcore::getEventDispatcher()->dispatch(
            'toolbox.dynamiclink.object.url',
            $event
        );

        return $event->getArgument('objectFrontendUrl');

    }

    /**
     * @param mixed $data
     * @return $this
     */
    public function setDataFromEditmode($data)
    {
        if (strpos($this->data['path'], '::') === false) {
            return parent::setDataFromEditmode($data);
        }

        $this->data['internal'] = true;
        $this->data['internalType'] = 'object';

        return $this;
    }
}