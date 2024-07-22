{{-- @extends('layouts.dashboardTemplate') --}}
@extends((((Auth::user()->profil->nomProfil == 'Promoteur'  ? 'layouts.dashboardTemplate' : Auth::user()->profil->nomProfil == 'PROVINCE') ? 'layouts.metier' : (Auth::user()->profil->nomProfil == 'REGION' ? 'layouts.metier' : Auth::user()->profil->nomProfil == 'DEP'))  ? 'layouts.metier' : Auth::user()->profil->nomProfil == 'SG') ? 'layouts.metier' : 'layouts.superadmin')

@section('content')
<div class="container-fluid">
    <div class="main-card card">
        <div class="card-header py-0">
            @php echo $controler->newFormButton($rub,$srub,'specialite.create'); @endphp
            <h4>Liste des spécialités</h4>
        </div>
    <div class="card-body table-responsive">
        <table id="example" class="table table-striped table-bordered">
            <thead >
                <tr>
                    <th>{{__('Secteur')}} </th>
                    <th>{{__('Filière')}} </th>
                    <th>{{__('Spécialité')}} </th>
                    <th>{{__('Actions')}} </th>
                    {{-- @php echo $controler->crudheader($rub,$srub); @endphp --}}
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $item)
                    <tr>
                        <td>{{$item->libelleSecteur}}</td>
                        <td>{{$item->libelleFiliere}}</td>
                        <td>{{$item->libelleSpecialite}}</td>
                        <td> @php $route = 'route'; echo $controler->crudbody($rub,$srub,$route,'specialite.edit','specialite.destroy',$item->id); @endphp </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<br>
    {{-- <a href="/exportExcelCause" >
        <button class="btn btn-primary btnEnregistrer">{{ __('liste.exporter') }}</button>
    </a> --}}
</div>
@endsection
