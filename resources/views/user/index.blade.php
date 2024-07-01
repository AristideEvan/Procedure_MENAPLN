@extends('layouts.dashboardTemplate')
@section('content')
    <div class="card">
        <div class="card-header">
            @php echo $controler->newFormButton($rub,$srub,'user.create'); @endphp
            {{-- <a href="{{route('register')}}"> 
                <input value="Nouveau" type="button" class="btn btn-primary btnEnregistrer" style="float:right">
            </a> --}} 
            <h4>{{ __('Liste des utilisateurs') }}</h4>
        </div>
        <div class="card-body">
            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Profil') }}</th>
                        <th>{{ __('Etat') }}</th>
                        <th> Actions</th>
                        <th> Actions</th>
                        {{-- @php echo $controler->crudheader($rub,$srub); @endphp --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item )
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->nomProfil }}</td>
                        <td>@if($item->actif) Actif @else Inactif @endif</td>
                        <td>
                            <a href="#" id="/changerEtatCompte/{{ $item->id }}"
                                onclick="changerEtatCompte(this.id,'')" 
                                @if($item->actif) title="Desactiver cet utilisateur" @else title="Activer cet utilisateur" @endif>
                                @if($item->actif) <i class="fas fa-times" style="color: #F00"></i> @else <i class="fas fa-check-circle" style="color: #060"></i> @endif    
                            </a>
{{-- 
                            <a href="{{ route('user.edit',$item->id) }}" title="Modifier"><i class="fa fa-pencil-alt" style="color: #060" aria-hidden="true"></i></a>
                            <a href="{{ route('user.destroy',$item->id) }}" title="Supprimer"><i class="fa fa-trash-alt" style="color: #F00" aria-hidden="true"></i></a> --}}
                        </td>
                        <td> @php $route = 'route'; echo $controler->crudbody($rub,$srub,$route,'user.edit','user.destroy',$item->id); @endphp </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection