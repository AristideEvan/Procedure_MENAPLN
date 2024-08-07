{{-- @extends('layouts.dashboardTemplate') --}}
@extends((((Auth::user()->profil->nomProfil == 'Promoteur'  ? 'layouts.dashboardTemplate' : Auth::user()->profil->nomProfil == 'PROVINCE') ? 'layouts.metier' : (Auth::user()->profil->nomProfil == 'REGION' ? 'layouts.metier' : Auth::user()->profil->nomProfil == 'DEP'))  ? 'layouts.metier' : Auth::user()->profil->nomProfil == 'SG') ? 'layouts.metier' : 'layouts.superadmin')
@section('content')
{{-- @section('content') --}}
<div class="container-fluid">
    <div class="main-card card">
        <div class="card-header py-0">
            @php echo $controler->newFormButton($rub,$srub,'action.create'); @endphp
            <h4>{{ __('Liste des actions') }}</h4>
        </div>
    <div class="card-body table-responsive">
        <table id="example" class="table table-striped table-bordered">
            <thead >
                <tr>
                    <th>{{__('Actions')}} </th>
                    {{-- @php echo $controler->crudheader($rub,$srub); @endphp --}}
                </tr>
            </thead>
            <tbody>
                @foreach($actions as $item)
                    <tr>
                        <td>{{$item->nomAction}}</td>
                        <td> @php $route = 'route'; echo $controler->crudbody($rub,$srub,$route,'action.edit','action.destroy',$item->id); @endphp </td>
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