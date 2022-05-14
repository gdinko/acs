<?php

namespace Gdinko\Acs\Actions;

trait ManagesHelp
{    
    /**
     * help
     *
     * @param  string $method
     * @return array
     */
    public function help(string $method): array
    {
        return $this->post(
            'ACSAutoRestHelp',
            ['ACSAlias' => $method],
        );
    }
}
