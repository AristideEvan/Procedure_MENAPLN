{{-- @extends('layouts.dashboardTemplate') --}}
@extends((((Auth::user()->profil->nomProfil == 'Promoteur'  ? 'layouts.dashboardTemplate' : Auth::user()->profil->nomProfil == 'PROVINCE') ? 'layouts.metier' : (Auth::user()->profil->nomProfil == 'REGION' ? 'layouts.metier' : Auth::user()->profil->nomProfil == 'DEP'))  ? 'layouts.metier' : Auth::user()->profil->nomProfil == 'SG') ? 'layouts.metier' : 'layouts.superadmin')

@section('content')
<div class="card">
    <div class="card-header">
        @php echo $controler->newFormButton($rub,$srub,'profil.create'); @endphp
        <h4>{{ __('Liste des profils') }}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                {{ csrf_field() }}
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>{{ __('Profil') }}</th>
                            {{-- @php echo $controler->crudheader($rub,$srub); @endphp --}}
                             <th>Actions</th>   
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($profils as $profil)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $profil->nomProfil }}</td>
                                <td> @php $route = 'route'; echo $controler->crudbody($rub,$srub,$route,'profil.edit','profil.destroy',$profil->id); @endphp </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection