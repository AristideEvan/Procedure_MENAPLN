@extends(Auth::user()->profil->nomProfil != 'Promoteur' ? 'layouts.metier' : 'layouts.dashboardTemplate')
{{-- @if(Auth::user()->profil->nomProfil != 'Promoteur') ? @extends('layouts.app') : @extends('layouts.dashboardTemplate')  --}}
 {{-- @extends('layouts.dashboardTemplate') --}}
@section('content')
        <div class="container-fluid" style="margin-top:15px;">
            <div class="main-card card">
                <div class="card-header py-1">
                 <div class="row">
                        <div class="col-2">
                             @php echo $controler->newFormButton($rub,$srub,'procedure.create'); @endphp
                        </div> 
                 </div>
                 <br/> 
                    <h4 class="card-title">
                        {{__('Liste de mes créations')}}
                    </h4>
                </div>
                <div class="card-body table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead >
                        <tr>
                            <th>Type Enseignement</th>
                            <th>Nom Etablissement</th>
                            <th>Superficie</th>
                            <th>Références</th>
                            <th>Localité</th>
                            <th>Statut</th>
                            <th>Actions</th>
                            {{-- <th></th> --}}
                            {{-- @php $controler->crudheader($rub,$srub); @endphp --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($demandes as $item)
                            <tr>
                                <td>{{$item->libelle}}</td>
                                <td>{{$item->nomEtablissement}}</td>
                                <td>{{$item->superficie}}</td>
                                <td>{{$item->reference}}</td>
                                <td>{{$item->nom_village}}</td>
                                <td @if($item->statut =='Non Paye') style="color: red" @elseif($item->statut=="Paye") style="color: orange"
                                @elseif($item->statut=="Signé") style="color: green" @else style="color: green" @endif >
                                @if($item->statut =='Non Paye')
                                    Non Payé
                                @elseif($item->statut=="Paye")
                                    Payé
                                @elseif($item->statut=="Signé")
                                    Signé
                                @elseif($item->statut=="Region")
                                    Région
                                @elseif($item->statut=="Province")
                                    Province
                                @elseif($item->statut=="DEP")
                                    DEP
                                @elseif($item->statut=="SG")
                                    SG
                                @elseif($item->statut=="Pour Modification")
                                    A modifier
                                @endif
                                </td>
                                <td style="text-align: right">
                                @if(Auth::user()->niveauAction !=null && ($item->statut == "Non Paye" || 
                                    $item->statut=="SG" || 
                                    $item->statut=="DEP" || 
                                    $item->statut=="Province" ||
                                    $item->statut=="Paye" ||   
                                    $item->statut=="Region"))

                                    <a id="{{ route('procedure.show', $item->id)}}" href="#" onclick="popUp(this.id,'showCreation')" title="Plus de détails1" >  <i class="fa fa-align-justify styleedit"  ></i></a> 
                                    {{-- @php $route = 'route'; echo $controler->crudbody($rub,$srub,$route,'procedure.edit','procedure.destroy',$item->id); @endphp --}}
                                    @php $route = 'route'; echo $controler->crudbody_metier($rub,$srub,$route,'procedure.edit','procedure.destroy',$item->id); @endphp
                                
                                @elseif(Auth::user()->niveauAction ==null && ($item->statut == "Pour Modification" || $item->statut == "Non Paye"))
                                    @php $route = 'route'; echo $controler->crudbody($rub,$srub,$route,'procedure.edit','procedure.destroy',$item->id); @endphp
                                    <a id="{{ route('procedure.show', $item->id)}}" href="#" onclick="popUp(this.id,'showCreation')" title="Plus de détails2" >  <i class="fa fa-align-justify styleedit"  ></i></a>
                                @else
                                    <a id="{{ route('procedure.show', $item->id)}}" href="#" onclick="popUp(this.id,'showCreation')" title="Plus de détails3" >  <i class="fa fa-align-justify styleedit"  ></i></a>
                                
                                @endif
                                {{-- @php $controler->crudheader($rub,$srub); @endphp --}}

                                </td>

                            </tr>
                        @endforeach
                    </tbody> 
                </table>
            </div>
        </div>
@endsection

{{-- @endif --}}
