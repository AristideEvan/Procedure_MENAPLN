@extends('layouts.dashboardTemplate')

@section('content')
<div class="container-fluid">
    <div class="main-card card">
        <div class="card-header py-0">
            @php echo $controler->newFormButton($rub,$srub,'secteur.create'); @endphp
            <h4>Liste des secteurs</h4>
        </div>
    <div class="card-body table-responsive">
        <table id="example" class="table table-striped table-bordered">
            <thead >
                <tr>
                    {{-- <th>{{__('Code')}} </th> --}}
                    <th>{{__('Libellé')}} </th>
                    <th>{{__('Description')}} </th>
                    <th>{{__('Action')}} </th>
                    {{-- @php echo $controler->crudheader($rub,$srub); @endphp --}}
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $item)
                    <tr>
                        <td>{{$item->libelleSecteur}}</td>
                        <td>{{$item->description}}</td>
                        <td> @php $route = 'route'; echo $controler->crudbody($rub,$srub,$route,'secteur.edit','secteur.destroy',$item->id); @endphp </td>
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
