
@extends('layouts.app')

@section('content')
  
  {{-- <br/>
  @if(isset($data))
      @php  $som=$data->sum('nbredemandestraitees')  @endphp 
      <h6>
          Nombre de demandes traitées : {{ $som }}      
      </h6>
    @endif  
  <br/>

  <br/>
  @if(isset($data1))
      @php  $som1=$data1->sum('nbredemandesencours')  @endphp 
      <h6>
          Nombre de demandes en cours : {{ $som1 }}      
      </h6>
  @endif  
  <br/>  

  <br/>   
    @if(isset($data2))
      @php  $som2=$data2->sum('nbredemandestotal')  @endphp 
      <h6>
          Nombre de demandes totales : {{ $som2 }}      
      </h6>
    @endif  
  <br/> 
  
  <br/>   
    @if(isset($data3))
      @php  $som3=$data3->sum('nbredemandesmodification')  @endphp 
      <h6>
          Nombre de demandes à modifier : {{ $som3 }}      
      </h6>
    @endif  
  <br/>  --}}

    {{-- @if(isset($data2))

      @php  $som =0; @endphp 
      @foreach ( $data2 as $demande2)
        @php $som +=  (float)$demande2 @endphp    
      @endforeach
      
        <h6>
            Nombre total de demandes :
          @php  $som ; @endphp  
        </h6> 
                
    @endif  --}}

      {{-- <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th scope="col">N°</th>
              <th scope="col">Nom Etablissement</th>
              <th scope="col">reference</th>
            </tr>
          </thead>
          <tbody>

                @if(isset($data))      
                      @foreach($data as $demande)
                        <tr>
                              <th scope="row">{{ $loop-> index + 1 }}</th>
                              <td>{{ $demande->nomEtablissement }}</td>
                              <td>{{ $demande->reference }}</td>

                              
                        </tr>      
                      @endforeach  
                @endif      
          </tbody>

        </table>
    --}}
<br/>
<br/>
 <div><h5> ICI EST RESERVÉ POUR LES INFORMATIONS DES CONTACTS</h5>  </div>
@endsection