@extends('layouts.dashboardTemplate')
@section('content')
    <div class="container-fluid">
        <div class="main-card card">
            <div class="card-header py-0">
                @php echo $controler->newFormButton($rub,$srub,'menu.create'); @endphp
                <h4 class="card-title">
                    {{__('Liste des menus')}}
                </h4>
            </div>
            <div class="card-body table-responsive">
            <table id="example" class="table table-striped table-bordered">
                <thead >
                    <tr>
                        <th>
                            Menu</th>
                        <th>Parent</th>
                        <th>{{__('lien')}} </th>
                        <th>{{__('Ordre')}} </th>
                        <th>{{__('Icone')}} </th>
                        {{-- @php echo $controler->crudheader($rub,$srub); @endphp --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($listeMenus as $item)
                        <tr>
                            <td>{{$item->nomMenu}}</td>
                            <td>{{$item->nomParent}}</td>
                            <td>{{$item->lien}}</td>
                            <td>{{$item->ordre}}</td>
                            <td>{{$item->icon}}</td>
                            <td>@php $route = 'route'; echo $controler->crudbody($rub,$srub,$route,'menu.edit','menu.destroy',$item->id); @endphp</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection