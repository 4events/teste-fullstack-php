<?php

namespace App\Http\Controllers;

use App\Http\Exceptions\DefaultException;
use App\Http\Exceptions\NotFoundException;
use App\Http\Exceptions\UnprocessableEntityException;
use App\Models\Car;

use Swoole\Http\Request;

class CarsController
{

    /**
     * @return array
     */
    public function index(): array
    {
        try {
            $cars = (new Car())->all();

            if(!count($cars))
                throw new NotFoundException();

            return response($cars);
        } catch (\Exception $error) {
            return (new DefaultException($error))->getError();
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function show(Request $request): array
    {
        try {

            if(!$car = (new Car())->find($request->get['id']))
                throw new NotFoundException();

            return response(
                $car
            );

        } catch (\Exception $error) {
            return (new DefaultException($error))->getError();
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request): array
    {
        try {

            if(!$data = $request->post)
                throw new UnprocessableEntityException();

            if(!$data['vehicle'])
                throw new UnprocessableEntityException('The field `vehicle` is required');

            if(!$data['year'])
                throw new UnprocessableEntityException('The field `year` is required');

            if(!$data['description'])
                throw new UnprocessableEntityException('The field `description` is required');

            if($data['is_sold'] === null || $data['is_sold'] === '')
                throw new UnprocessableEntityException('The field `is sold` is required');

            if(intval($data['is_sold']) !== 0 && intval($data['is_sold']) !== 1)
                throw new UnprocessableEntityException('The field `is sold` is invalid');

            (new Car())->insert($data);

            return response([]);
        } catch (\Exception $error) {
            return (new DefaultException($error))->getError();
        }
    }

}