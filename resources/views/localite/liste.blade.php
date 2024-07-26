<div class="main-card card">
    <div class="card-header py-0">
        
        <h5 class="card-title">
            {{__('Liste des localités')}}
        </h5>

    </div>
    <div class="card-body table-responsive">
        <table id="example" class="table table-striped table-bordered">
            <thead >
                <tr>
                    <th>{{__('Région')}} </th>
                    <th>{{__('Province')}} </th>
                    <th>{{__('Commune')}} </th>
                    <th>{{__('Village')}} </th>
                    {{-- <th></th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($localites as $item)
                    <tr>
                        <td>{{$item->nomregion}}</td>
                        <td>{{$item->nomprovince}}</td>
                        <td>{{$item->nomcommune}}</td>
                        <td>{{$item->nomvillage}}</td>
                        {{-- <td style="text-align: right">
                            <a href="{{ route('localite.edit', $item->id)}}" >  <i class="fa fa-pencil styleedit"  ></i></a>
                            <a  href="#" id="{{route('localite.destroy',$item->id)}}"
                                onclick="Supprimer(this.id,'');"> <i class="fa fa-trash styledelete" ></i> </a>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
</div>
<script>
    jQuery(document).ready(function() {
    jQuery('#example').DataTable( {
        "language": {
            "sProcessing": "Traitement en cours ...",
            "sLengthMenu": "Afficher _MENU_ lignes",
            "sZeroRecords": "Aucun résultat trouvé",
            "sEmptyTable": "Aucune donnée disponible",
            "sInfo": "Lignes _START_ à _END_ sur _TOTAL_",
            "sInfoEmpty": "Aucune ligne affichée",
            "sInfoFiltered": "(Filtrer un maximum de_MAX_)",
            "sInfoPostFix": "",
            "sSearch": "Chercher:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Chargement...",
            "oPaginate": {
              "sFirst": "Premier", "sLast": "Dernier", "sNext": ">", "sPrevious": "<"
            },DataTable
            "oAria": {
              "sSortAscending": ": Trier par ordre croissant", "sSortDescending": ": Trier par ordre décroissant"
            }
          },
          dom: 'Blfrtip',
          buttons: [
            //'copyHtml5',
            'excelHtml5',
            //'csvHtml5',
            'pdfHtml5'
        ],
          responsive: true,
          "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tout"]],
          colReorder: true,
          ordering: true
      } );
  } );
</script>