@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="card gradient-1">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Kamar Terisi</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">{{ $occupiedRoomsCount }}</h2>
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card gradient-2">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Kamar Kosong</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">{{ $emptyRoomsCount }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card gradient-3">
                                <div class="card-body">
                                    <h6 class="card-title text-white">Keluhan Belum Selesai</h6>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">{{ $unresolvedComplaintsCount }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card gradient-4">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Belum Bayar</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">{{ $belumBayarCount }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                
                            </div>
                        </div>
                    </div>

                    

                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Keluhan</h4>
                                    <div id="activity">
                                        @php $count = 0; @endphp
                                        @foreach ($keluhans as $keluhan)
                                            @if ($keluhan->status === 'Proses')
                                                <div class="media border-bottom-1 pt-3 pb-3">
                                                    <!-- Assuming you have an 'avatar' field in your Keluhan model -->
                                                    <div class="media-body">
                                                        <h5>{{ $keluhan->penyewa->nama }}</h5>
                                                        <p class="mb-0">{{ $keluhan->keterangan }}</p>
                                                    </div>
                                                </div>
                                                @php $count++; @endphp
                                                @if ($count == 5) @break @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Calon Penyewa</h4>
                                    <div id="activity">
                                        @php $count = 0; @endphp
                                        @foreach ($calonpenyewas as $calonpenyewa)
                                            <div class="media border-bottom-1 pt-3 pb-3">
                                                <!-- Assuming you have 'nama' and 'tanggal_masuk' fields in your Calonpenyewa model -->
                                                <div class="media-body">
                                                    <h5>{{ $calonpenyewa->nama }}</h5>
                                                    <p class="mb-0">Tanggal Masuk: {{ $calonpenyewa->tanggal_masuk }}</p>
                                                </div>
                                            </div>
                                            @php $count++; @endphp
                                            @if ($count == 5) @break @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Habis Masa Sewa</h4>
                                    <div id="activity">
                                        @php $count = 0; @endphp
                                        @foreach ($penyewas as $penyewa)
                                            @if (now()->greaterThan($penyewa->tanggal_selesai))
                                                <div class="media border-bottom-1 pt-3 pb-3">
                                                    <div class="media-body">
                                                        <h5>{{ $penyewa->nama }}</h5>
                                                        <p class="mb-0">Tanggal Selesai: {{ $penyewa->tanggal_selesai }}</p>
                                                        <p class="mb-0">Nomor Kamar: {{ $penyewa->nomor_kamar }}</p>
                                                    </div>
                                                </div>
                                                @php $count++; @endphp
                                                @if ($count == 5) @break @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="active-member">
                                        <div class="table-responsive">
                                            <table class="table table-xs mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Pembayar</th>
                                                        <th>Status Bayar</th>
                                                        <th>Tanggal Bayar</th>
                                                        <th>Batas Bayar</th>
                                                        <th>Harga</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($lastPayments->take(7) as $payment)
                                                        <tr>
                                                            <td>{{ $payment->nama_pembayar }}</td>
                                                            <td>
                                                                <i class="{{ $payment->status_bayar == 'Terbayar' ? 'fas fa-check-circle text-success' : 'fas fa-exclamation-circle text-warning' }}"></i>
                                                                {{ $payment->status_bayar }}
                                                            </td>
                                                            <td>{{ $payment->tanggal_bayar }}</td>
                                                            <td>{{ $payment->batas_bayar }}</td>
                                                            <td>{{ $payment->harga }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>          
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Tabel Pemasukan Bulanan</h4>
                                            <canvas id="myChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    var ctx = document.getElementById('monthlyPaymentChart').getContext('2d');
    var data = {!! json_encode($monthlyIncome) !!};

    var monthlyPaymentChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.months,
            datasets: [{
                label: 'Total Pembayaran',
                data: data.totalPayments,
                backgroundColor: 'rgba(75, 192, 192, 0.6)', // Adjusted transparency for a softer look
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        borderDash: [3, 3], // Dotted grid lines for a cleaner appearance
                    }
                },
                x: {
                    grid: {
                        display: false // Remove x-axis grid lines for cleaner appearance
                    }
                }
            },
            plugins: {
                legend: {
                    display: false // Hide legend for simplicity
                }
            }
        }
    });
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chartValue = {!! json_encode($remappedTotalIncome) !!};
    console.log(chartValue, 'chartValue');
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: [{
                label: 'Total Income',
                data: chartValue,
                backgroundColor: 'rgba(54, 162, 235, 0.6)', // Adjusted color and transparency
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        borderDash: [3, 3], // Dotted grid lines for a cleaner appearance
                    }
                },
                x: {
                    grid: {
                        display: false // Remove x-axis grid lines for cleaner appearance
                    }
                }
            },
            plugins: {
                legend: {
                    display: false // Hide legend for simplicity
                }
            }
        }
    });
</script>

@endsection