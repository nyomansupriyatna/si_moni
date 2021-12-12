<div {{ $attributes }}>
    Periode {{\Carbon\Carbon::parse($tanggal)->locale('id')->format('F Y')}}
</div>
