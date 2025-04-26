@extends('base')

@section('content')

    <div class="content container-fluid">
        <div id="printableArea">

            @include('entetes.head', ['entete' => $entete])


            <h1>Détails du Client : {{ $client->nom }}</h1>
            <p>Contact : {{ $client->contact }}</p>

            <h2>Stocks associés</h2>
            <table  class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Catégorie de Poissons</th>
                    <th>Nombre de Caisses</th>
                    <th>Quantité Totale (kg)</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($client->stocksGroupes as $etatStock)
                    <tr>
                        <td>{{ $etatStock->categorieDePoissons->nom }}</td>
                        <td>{{ $etatStock->nombre_caisses }}</td>
                        <td>{{  $etatStock->nombre_caisses*20 }} kg</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <h2>Tunnels associés</h2>
            <table  class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Catégorie de Poissons</th>
                    <th>Nombre de Plats</th>
                    <th>Quantité Totale (tonnes)</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($client->tunnelsGroupes as $etatTunnel)
                    <tr>
                        <td>{{ $etatTunnel->categorieDePoissons->nom }}</td>
                        <td>{{ $etatTunnel->nombre_plats }}</td>
                        <td>{{  $etatTunnel->nombre_plats *10 }} tonnes</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

        <!-- Bouton d'impression -->
        <button onclick="printCard()" class="btn btn-primary" style="width: 200px">Imprimer</button>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Retour à la Liste</a>
    </div>

@endsection

@section('scripts')
    <script>
        function printCard() {
            var printContents = document.getElementById('printableArea').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            window.location.reload(); // Recharge la page pour restaurer l'état initial
        }
    </script>
@endsection
