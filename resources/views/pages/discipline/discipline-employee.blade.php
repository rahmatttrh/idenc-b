@extends('layouts.app')
@section('title')
Discipline
@endsection
@section('content')

<div class="page-inner">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Discipline</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
               
                <div class="card-body ">
                  <div class="d-flex justify-content-between">
                     <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link " id="pills-home-tab"  href="{{ route('discipline') }}" >Rekap Disiplin</a>
                        </li>
                        
                        
                        <li class="nav-item">
                           <a class="nav-link" id="pills-profile-tab" href="{{ route('discipline.draft') }}">Draft</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="pills-profile-tab" href="{{ route('discipline.import') }}">Import</a>
                        </li>
                        
                     </ul>

                    

                     
                  </div>
                  
                  

                   
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <table>
                           <thead>
                              <tr>
                                 <th colspan="2">Disiplin Karyawan</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>{{$employee->nik}}</td>
                                 
                                 
                              </tr>
                              <tr>
                                 <td>{{$employee->biodata->fullName()}}</td>
                              </tr>
                              <tr>
                                 <td>{{$year}}</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                     <div class="col-md-9">
                        <div class="table-responsive">
                           <table id="" class=" table-sm  ">
                               <thead>
                                   <tr>
                                       <th class="text-center">No</th>
                                       
                                       <th>Bulan</th>
                                       <th class="text-center">Alpa</th>
                                       <th class="text-center">Ijin</th>
                                       <th class="text-center">Terlambat</th>
                                       <th class="text-center">Achievement</th>
                                       <th class="text-right">Action</th>
                                   </tr>
                               </thead>
                               <tbody>
   
                                   @foreach ($datas as $data)
                                   <tr>
                                       <td class="text-center">{{++$i}}</td>
                                       
                                       <td>{{getMonthNameIndonesian($data->bulan)}}</td>
                                       
                                       <td class="text-center">{{$data->alpa}}</td>
                                       <td class="text-center">{{$data->ijin}}</td>
                                       <td class="text-center">{{$data->terlambat}}</td>
                                       <td class="text-center">
                                           <?php
                                           if ($data->achievement > 2) {
                                               # code...
                                               echo "<span class='badge badge-success'>";
                                           } else {
                                               # code...
                                               echo "<span class='badge badge-danger'>";
                                           }
   
                                           ?>
   
                                           {{$data->achievement}}</span>
                                       </td>
                                       <td>-</td>
                                   </tr>
                                   @endforeach
                                   
                               </tbody>
                           </table>
                       </div>
                     </div>
                  </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js_footer')
<script>
    $(document).ready(function() {

        $('#boxCreate').hide();

        bulanPenilaian();

        $("#btnCreate").click(function() {

            $('#boxCreate').show();
            // Tambahkan kode lain yang ingin Anda eksekusi saat tombol diklik di sini
        });

        $("#hide").click(function() {

            $('#boxCreate').hide();
            // Tambahkan kode lain yang ingin Anda eksekusi saat tombol diklik di sini
        });

        $('.date').change(function() {
            bulanPenilaian();
        });

        $('#employe_id').change(function() {
            let employeeId = $(this).val();

            $('#employee_id').val(employeeId);

            $("#tableCreate tbody").empty();

            $.ajax({
                url: '/kpi/employe/' + employeeId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {

                    $('#kpi_id').val(data[0].kpi_id);

                    var table = $("#tableCreate tbody");
                    $.each(data, function(index, rowData) {
                        var row = $("<tr>").attr("id", "row_" + rowData.id); // Tambahkan ID indeks pada baris
                        row.append($("<td>").text(index + 1));
                        row.append($("<td>").text(rowData.objective));
                        row.append($("<td>").text(rowData.weight));
                        row.append($("<td>").text(rowData.target));
                        var input = $("<input>").attr({
                            "type": "text",
                            "class": "form-control",
                            "name": `qty[${rowData.id}]`, // Menggunakan ID sebagai bagian dari array name
                            "value": 0,
                            "min": 0.01,
                            "max": rowData.target,
                            "step": "0.01" // Step untuk 2 digit desimal
                        }).on('input', function() {
                            // Menghapus angka nol di depan input jika ada
                            var inputValue = $(this).val();
                            inputValue = inputValue.replace(/^0+/, '');
                            $(this).val(inputValue);

                            calculateAchievement(rowData.id, rowData.target);
                            calculateTotalAchievement();
                        });

                        row.append($("<td>").append(input));
                        var achievementInput = $("<input>").attr({
                            "type": "text",
                            "class": "form-control text-bold",
                            "name": "achievement_" + rowData.id,
                            "placeholder": "0",
                            "readonly": true
                        }).css("font-weight", "bold"); // Menambahkan style font-weight: bold

                        row.append($("<td>").append(achievementInput));

                        var attachmentInput = $("<input>").attr({
                            "type": "file",
                            "class": "form-control",
                            "name": `attachment[${rowData.id}]`, // Menggunakan ID sebagai bagian dari array name
                            "required": true, // Tambahkan atribut readonly
                            "accept": ".pdf" // Hanya izinkan file PDF
                        });

                        row.append($("<td>").append(attachmentInput));


                        table.append(row);
                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX Error:', textStatus, errorThrown);
                }
            });

        });

        function validasiInput(index) {

            var inputVal = parseFloat($(`input[name="qty[${index}]"]`).val());

        }

        function calculateAchievement(index, target) {

            // validasi dulu
            // validasiInput(index);

            var inputVal = parseFloat($(`input[name="qty[${index}]"]`).val()) || 0; // Menggantikan dengan nilai 0 jika null atau kosong
            // var inputVal = parseFloat($(`input[name="qty[${index}]"]`).val()) || 0.1; // Ganti 0 dengan 0.1 jika null atau kosong

            // var inputVal = parseFloat($(`input[name="qty[${index}]"]`).val());

            // if (isNaN(inputVal) || inputVal <= 0) {
            //     inputVal = 0; // Set nilai ke 0.1 jika kosong atau bernilai 0
            //     $(`input[name="qty[${index}]"]`).val(inputVal)
            // }

            var targetVal = parseFloat($(`#tableCreate tbody #row_${index} td:eq(3)`).text());
            var weightVal = parseFloat($(`#tableCreate tbody #row_${index} td:eq(2)`).text());

            if (!isNaN(inputVal) && inputVal >= 0.1 && inputVal <= target) {
                var result = (inputVal / targetVal) * weightVal;
                $(`input[name="achievement_${index}"]`).val(Math.round(result));
            } else {
                $(`input[name="achievement_${index}"]`).val("Invalid Input");
            }
        }

        function calculateTotalAchievement() {
            var totalAchievement = 0;
            $("input[name^='achievement_']").each(function() {
                var value = parseFloat($(this).val());
                if (!isNaN(value)) {
                    totalAchievement += value;
                }
            });

            $("#totalAchievement").text(totalAchievement.toFixed(2));
        }

        // Fungsi untuk mengosongkan tabel
        function clearTable() {
            $("#tableCreate tbody").empty();
        }

        function bulanPenilaian() {
            let bulan = $('#bulan').val();
            let tahun = $('#tahun').val();

            let date = tahun + '-' + bulan + '-01';

            $('#date').val(date);

        }

    })
</script>
@endpush