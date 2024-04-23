<?php

use Routes\Router;
use App\Exception\RouteNotFoundException;

/**
 * 
 * 
 * CLASS APP NOUS PERMET TOUT SIMPLEMENT DE RUN LES URL
 * 
 * UNE INJECTION DE DEPENDENCE
 * 
 * 
 */

class App 
{
    protected $application;

    public function __construct(Router $application)
    {
        $this->application = $application;
    }

    /**
     * Undocumented function
     * 
     * CETTE METHOD FAIT JUSTE LA RUN
     *
     * @return void
     */
    public function bind()
    {
        try {

            $this->application->run();
        
        } catch (RouteNotFoundException $e) {
            return $e->NotFound();
        }
    }
}