<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resep Dokter - {{ $medicalRecord->appointment->patient->user->name }} - {{ now()->format('d-m-Y') }}</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; }
        .container { width: 148mm; margin: 0 auto; padding: 10mm; border: 1px solid #ddd; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 18pt; text-transform: uppercase; }
        .header p { margin: 2px 0; font-size: 10pt; }
        .info-table { width: 100%; margin-bottom: 20px; font-size: 11pt; }
        .info-table td { padding: 4px; vertical-align: top; }
        .rx-header { font-size: 24pt; font-weight: bold; font-style: italic; margin-bottom: 10px; }
        .prescription-list { list-style: none; padding: 0; margin-bottom: 40px; }
        .prescription-list li { margin-bottom: 15px; border-bottom: 1px dashed #ccc; padding-bottom: 10px; }
        .med-name { font-weight: bold; font-size: 12pt; }
        .med-dosage { font-style: italic; }
        .footer { text-align: right; margin-top: 50px; }
        .signature-box { display: inline-block; text-align: center; width: 200px; }
        .signature-line { border-bottom: 1px solid #000; margin-bottom: 5px; height: 50px; }
        @media print {
            body { margin: 0; }
            .container { border: none; width: 100%; }
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <div class="header">
            <h1>Klinik HealthCare</h1>
            <p>Jl. Kesehatan No. 123, Jakarta Selatan</p>
            <p>Telp: (021) 555-0123 • Email: clinic@healthcare.com</p>
        </div>

        <table class="info-table">
            <tr>
                <td width="20%"><strong>Dokter</strong></td>
                <td>: {{ $medicalRecord->appointment->doctor->user->name }}</td>
                <td width="15%"><strong>SIP</strong></td>
                <td>: {{ $medicalRecord->appointment->doctor->license_no }}</td>
            </tr>
            <tr>
                <td><strong>Pasien</strong></td>
                <td>: {{ $medicalRecord->appointment->patient->user->name }}</td>
                <td><strong>Tgl</strong></td>
                <td>: {{ $medicalRecord->visit_date->format('d/m/Y') }}</td>
            </tr>
        </table>

        <div class="rx-header">R/</div>

        <ul class="prescription-list">
            @forelse($medicalRecord->prescriptions as $rx)
            <li>
                <div class="med-name">{{ $rx->medication }} ({{ $rx->dosage }})</div>
                <div class="med-instruction">S {{ $rx->instructions }}</div>
            </li>
            @empty
            <li>
                <em>Tidak ada resep obat.</em>
            </li>
            @endforelse
        </ul>

        <div class="footer">
            <div class="signature-box">
                <p>Jakarta, {{ now()->format('d F Y') }}</p>
                <div class="signature-line"></div>
                <strong>{{ $medicalRecord->appointment->doctor->user->name }}</strong>
            </div>
        </div>

        <div class="no-print" style="margin-top: 20px; text-align: center;">
            <button onclick="window.print()" style="padding: 10px 20px; font-size: 14pt; cursor: pointer;">Cetak Resep</button>
            <button onclick="window.close()" style="padding: 10px 20px; font-size: 14pt; cursor: pointer;">Tutup</button>
        </div>
    </div>
</body>
</html>
