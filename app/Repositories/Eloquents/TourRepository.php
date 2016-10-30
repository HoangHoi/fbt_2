<?php

namespace App\Repositories\Eloquents;

use App\Models\Tour;
use App\Models\Place;
use DB;

class TourRepository extends BaseRepository
{

    public function __construct(Tour $tour)
    {
        parent::__construct();
        $this->model = $tour;
    }

    public function model()
    {
        return Tour::class;
    }

    public function create($request)
    {
        $tourRequest = $request->only([
            'name',
            'category_id',
            'price',
            'num_day',
            'description',
        ]);
        $tourCreate = parent::create($tourRequest);
        if (isset($request['places']) && $tourCreate['status']) {
            $places = [];
            foreach ($request->places as $place) {
                if (Place::find($place)) {
                    $places[] = $place;
                }
            }
            $tourCreate['data']->places()->attach($places);
        }

        return $tourCreate;
    }

    public function update($request, $id)
    {
        $tourRequest = $request->only([
            'name',
            'category_id',
            'price',
            'num_day',
            'description',
        ]);
        $tourUpdate = parent::update($tourRequest, $id);
        $tourUpdate['data']->places()->detach();
        if (isset($request['places']) && $tourUpdate['status']) {
            $places = [];
            foreach ($request->places as $place) {
                if (Place::find($place)) {
                    $places[] = $place;
                }
            }
            $tourUpdate['data']->places()->attach($places);
        }

        return $tourUpdate;
    }

    public function delete($ids)
    {
        try {
            DB::beginTransaction();
            if (is_array($ids)) {
                $tours = $this->model->whereIn('id', $ids);
                foreach ($tours->get() as $tour) {
                    $tour->places()->detach();
                    $tour->images()->delete();
                    $tour->reviews()->delete();
                    $tour->rates()->delete();
                }
                $data = $tours->delete();
            } else {
                $tour = $this->model->find($ids);
                $tour->places()->detach();
                $tour->images()->delete();
                $tour->reviews()->delete();
                $tour->rates()->delete();
                $data = $tour->delete();
            }

            if (!$data) {
                return [
                    'status' => false,
                    'message' => trans('messages.db_delete_error'),
                ];
            }

            DB::commit();

            return [
                'status' => true,
                'data' => $data,
            ];
        } catch (Exception $e) {
            DB::rollBack();

            return [
                'status' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function showAll()
    {
        $this->model = $this->model
            ->select([
                'id',
                'name',
                'price',
                'category_id',
                'num_day',
                'rate_average',
                'description',
            ])
            ->withCount('reviews')
            ->with(['places', 'category']);

        return $this;
    }

    public function show($id)
    {
        return $this->model
                ->with(['tourSchedules', 'places', 'category', 'images'])
                ->find($id);
    }
}
