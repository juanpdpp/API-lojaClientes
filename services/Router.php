<?php
    class Router {
        private array $routes;

        public function __construct() {
            $this->routes = [
                'GET' => [
                    '/clientes' => [
                        'controller' => 'ClienteController',
                        'function' => 'getClientes'
                    ],
                    '/pedidos' => [
                        'controller' => 'PedidoController',
                        'function' => 'getPedidos'
                    ],
                ],
                'POST' => [
                    '/cadastrar-cliente' => [
                        'controller' => 'ClienteController',
                        'function' => 'createCliente'
                    ],
                    '/cadastrar-pedido' => [
                        'controller' => 'PedidoController',
                        'function' => 'createPedido'
                    ]
                ],
                'PUT' => [
                    '/editar-cliente' => [
                        'controller' => 'ClienteController',
                        'function' => 'updateCliente'
                    ]
                ]
            ];
        }

        public function handleRequest(string $method, string $route): string {
            $routeExists = !empty($this->routes[$method][$route]);

            if (!$routeExists) {
                return json_encode([
                    'error' => 'Essa rota não existe!',
                    'result' => null
                ]);
            }

            $routeInfo = $this->routes[$method][$route];

            $controller = $routeInfo['controller'];
            $function = $routeInfo['function'];

            require_once __DIR__ . '/../controllers/' . $controller . '.php';

            return (new $controller)->$function();
        }
    }
?>