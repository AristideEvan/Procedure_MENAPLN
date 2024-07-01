@extends('layouts.dashboardTemplate')

@section('content')
<div class="card">
    <div class="card-header">
        @php echo $controler->newFormButton($rub,$srub,'typePromoteur.create'); @endphp
        <h4>{{ __('Liste des Type Promoteur') }}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                {{ csrf_field() }}
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>{{ __('Type Promoteur') }}</th>
                            <th>{{ __('Actions') }}</th>
                            {{-- @php echo $controler->crudheader($rub,$srub); @endphp --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($typepromoteurs  as $typepromoteur)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $typepromoteur->libelle }}</td>
                                <td> @php $route = 'route'; echo $controler->crudbody($rub,$srub,$route,'typePromoteur.edit','typePromoteur.destroy',$typepromoteur->id); @endphp <td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection