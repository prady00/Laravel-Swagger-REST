<?php
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Manager;

class ApiController extends Controller
{
    
    protected $availableEmbeds = ['groups', 'profiles'];
    
    protected $statusCode = 200;
    
    public function __construct(Manager $fractal) {
        $this->fractal = $fractal;
    }
    
    public function getStatusCode() {
        return $this->statusCode;
    }
    
    public function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;
        return $this;
    }
    
    protected function respondWithItem($item, $callback) {
        $resource = new Item($item, $callback);
        
        $rootScope = $this->fractal->createData($resource);
        
        return $this->respondWithArray($rootScope->toArray());
    }
    
    protected function respondWithPagination($item, $transformer) {
        if ($item == null) {
            return Response::json(null, $this->statusCode);
        }
        
        $paginator = $item;
        
        $resource = new Collection($item, $transformer);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        
        $rootScope = $this->fractal->createData($resource);
        
        return $this->respondWithArray($rootScope->toArray());
    }
    
    protected function respondWithCollection($collection, $callback) {
        $resource = new Collection($collection, $callback);
        
        $rootScope = $this->fractal->createData($resource);
        
        return $this->respondWithArray($rootScope->toArray());
    }
    
    protected function respondWithArray(array $array, array $headers = []) {
        return Response::json($array, $this->statusCode, $headers);
    }
}
