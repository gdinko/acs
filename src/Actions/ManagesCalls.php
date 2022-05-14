<?php

namespace Gdinko\Acs\Actions;

trait ManagesCalls
{

    public function __call($name, $arguments)
    {
        return $this->post(
            'ACSAutoRest',
            [
                'ACSAlias' => $name,
                'ACSInputParameters' => array_merge(
                    $arguments[0] ?? [],
                    $this->getCompanyData()
                )
            ]
        );
    }
}
