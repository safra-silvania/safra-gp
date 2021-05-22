<?php
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

/*
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 */
/** @var \Cake\Routing\RouteBuilder $routes */
$routes->setRouteClass(DashedRoute::class);

Router::scope('/api/v1', function (RouteBuilder $routes) {
    $routes->setExtensions(['json']);
    
    $routes->connect('/plans/get-planning-data/*', ['controller' => 'Plans', 'action' => 'getPlanningData']);
    $routes->connect('/plans/reorder/*', ['controller' => 'Plans', 'action' => 'reorder']);
    $routes->connect('/plans/update-detail-population/*', ['controller' => 'Plans', 'action' => 'updateDetailPopulation']);
    $routes->connect('/sketches/upload/*', ['controller' => 'Sketches', 'action' => 'upload']);
    $routes->connect('/sketches/delete_file/*', ['controller' => 'Sketches', 'action' => 'deleteFile']);
    $routes->connect('/files/get-files-by-field/*', ['controller' => 'Files', 'action' => 'getFilesByField']);
    $routes->connect('/plans/bind-detail-to-selected-seed/*', ['controller' => 'Plans', 'action' => 'bindDetailToSelectedSeed']);
    
    $routes->connect('/plans/get-selected-seeds/*', ['controller' => 'Plans', 'action' => 'getSelectedSeeds']);
    $routes->connect('/selected-seeds/select-seed/*', ['controller' => 'SelectedSeeds', 'action' => 'selectSeed']);
    $routes->connect('/selected-seeds/unselect-seed/*', ['controller' => 'SelectedSeeds', 'action' => 'unselectSeed']);
    
    $routes->connect('/plans/get-selected-chemicals/*', ['controller' => 'Plans', 'action' => 'getSelectedChemicals']);
    $routes->connect('/selected-chemicals/select-chemical/*', ['controller' => 'SelectedChemicals', 'action' => 'selectChemical']);
    $routes->connect('/selected-chemicals/unselect-chemical/*', ['controller' => 'SelectedChemicals', 'action' => 'unselectChemical']);
});

$routes->scope('/', function (RouteBuilder $builder) {
    // Register scoped middleware for in scopes.
    $builder->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true,
    ]));

    /*
     * Apply a middleware to the current route scope.
     * Requires middleware to be registered through `Application::routes()` with `registerMiddleware()`
     */
    $builder->applyMiddleware('csrf');

    /*
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, templates/Pages/home.php)...
     */
    $builder->connect('/', ['controller' => 'Pages', 'action' => 'index']);
    $builder->connect('/login', ['controller' => 'Users', 'action' => 'login']);
    $builder->connect('/logout', ['controller' => 'Users', 'action' => 'logout']);
    $builder->connect('/test-email', ['controller' => 'Pages', 'action' => 'testEmail']);

    /*
     * Connect catchall routes for all controllers.
     *
     * The `fallbacks` method is a shortcut for
     *
     * ```
     * $builder->connect('/:controller', ['action' => 'index']);
     * $builder->connect('/:controller/:action/*', []);
     * ```
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $builder->fallbacks();
});

/*
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * $routes->scope('/api', function (RouteBuilder $builder) {
 *     // No $builder->applyMiddleware() here.
 *     // Connect API actions here.
 * });
 * ```
 */
