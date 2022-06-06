<x-app-layout>
    <link
	href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
	rel="stylesheet">
<div class="flex items-center justify-center min-h-screen bg-gray-900">
	<div class="col-span-12">
		<div class="overflow-auto lg:overflow-visible ">
			<table class="table text-gray-400 border-separate space-y-6 text-sm">
				<thead class="bg-gray-800 text-gray-500">
					<tr>
						<th class="p-3">Crypto</th>
						<th class="p-3 text-left">Cantidad</th>
						<th class="p-3 text-left">Valor (€)</th>
						<th class="p-3 text-left"></th>
                        <th class="p-3 text-left"></th>
					</tr>
				</thead>
				<tbody>
                    @foreach ($cryptos as $crypto)
					<tr class="bg-gray-800">
						<td class="p-3">
							<div class="flex align-items-center">
								<img class="rounded-full h-12 w-12  object-cover" src="https://images.unsplash.com/photo-1613588718956-c2e80305bf61?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=634&q=80" alt="unsplash image">
								<div class="ml-3">
									<div class="">{{$crypto->abr}}</div>
									<div class="text-gray-500"></div>
								</div>
							</div>
						</td>
						<td class="p-3">
                            {{$crypto->cantidad}}
                        </td>
						<td class="p-3 font-bold">
							{{$crypto->cantidad * ($binance->precio($crypto->abr . 'EUR'))['price']}} €
						</td>
                        <td></td>
						<td class="p-3 ">
							<a href="#" class="text-gray-400 hover:text-gray-100 mr-2">
								Recibir
							</a>
							<a href="#" class="text-gray-400 hover:text-gray-100  mx-2">
								Enviar
							</a>
							<a href="#" class="text-gray-400 hover:text-gray-100  ml-2">
								Convertir
							</a>
						</td>
					</tr>
                    @endforeach
				</tbody>
			</table>

            <table class="table text-gray-400 border-separate space-y-6 text-sm">
				<thead class="bg-gray-800 text-gray-500">
					<tr>
						<th class="p-3">Divisa</th>
						<th class="p-3 text-left">Cantidad</th>
						<th class="p-3 text-left">Valor (€)</th>
						<th class="p-3 text-left"></th>
                        <th class="p-3 text-left"></th>
					</tr>
				</thead>
				<tbody>
                    @foreach ($fiats as $fiat)
					<tr class="bg-gray-800">
						<td class="p-3">
							<div class="flex align-items-center">
								<img class="rounded-full h-12 w-12  object-cover" src="https://images.unsplash.com/photo-1613588718956-c2e80305bf61?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=634&q=80" alt="unsplash image">
								<div class="ml-3">
									<div class="">{{$fiat->divisa}}</div>
									<div class="text-gray-500"></div>
								</div>
							</div>
						</td>
						<td class="p-3">
                            {{$fiat->cantidad}}
                        </td>
						<td class="p-3 font-bold">
							{{$fiat->cantidad}} €
						</td>
                        <td></td>
						<td class="p-3 ">
							<a href="#" class="text-gray-400 hover:text-gray-100 mr-2">
								Comprar
							</a>
							<a href="#" class="text-gray-400 hover:text-gray-100  mx-2">
								Vender
							</a>
						</td>
					</tr>
                    @endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<style>
	.table {
		border-spacing: 0 15px;
	}

	i {
		font-size: 1rem !important;
	}

	.table tr {
		border-radius: 20px;
	}

	tr td:nth-child(n+5),
	tr th:nth-child(n+5) {
		border-radius: 0 .625rem .625rem 0;
	}

	tr td:nth-child(1),
	tr th:nth-child(1) {
		border-radius: .625rem 0 0 .625rem;
	}
</style>
</x-app-layout>
