@props(['percentage', 'label' => null])

<div {{ $attributes->class('meter') }} role="progressbar" aria-label="{{ $label ?? __('Tickets sold') }}" aria-valuemin="0" aria-valuemax="100" aria-valuenow="{{ $percentage }}">
    <div style="width: {{ max(2, $percentage) }}%"></div>
</div>
