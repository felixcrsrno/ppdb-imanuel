@props(['status' => 'neutral', 'label' => null])
@php
    $meta = [
        'draft' => ['label' => 'Belum Lengkap', 'tone' => 'neutral'], 'pending' => ['label' => 'Menunggu Verifikasi', 'tone' => 'warning'],
        'verified' => ['label' => 'Terverifikasi', 'tone' => 'success'], 'passed' => ['label' => 'Diterima', 'tone' => 'info'],
        'rejected' => ['label' => 'Ditolak', 'tone' => 'danger'], 'failed' => ['label' => 'Ditolak', 'tone' => 'danger'],
        'uploaded' => ['label' => 'Sudah Upload', 'tone' => 'success'], 'missing' => ['label' => 'Belum Upload', 'tone' => 'neutral'],
    ][$status] ?? ['label' => ucfirst((string) $status), 'tone' => 'neutral'];
@endphp
<x-badge :type="$meta['tone']" {{ $attributes }}><span class="status-dot" aria-hidden="true"></span>{{ $label ?? $meta['label'] }}</x-badge>

