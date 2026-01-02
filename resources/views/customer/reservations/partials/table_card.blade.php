@php
    $isBooked = $table->status !== 'active' || in_array($table->id, $bookedTableIds);
@endphp

<div class="col">
    <input type="radio" class="btn-check" name="table_id" id="table{{ $table->id }}"
        autocomplete="off" value="{{ $table->id }}" 
        {{ $isBooked ? 'disabled' : '' }} required>

    <label class="btn w-100 p-3 shadow-sm table-node {{ $isBooked ? 'node-booked' : 'node-available' }}"
        for="table{{ $table->id }}">
        
        <div class="node-content">
            <div class="mb-2">
                @if($isBooked)
                    <i class="fas fa-lock opacity-50"></i>
                @else
                    <i class="fas fa-utensils"></i>
                @endif
            </div>
            
            <span class="d-block fw-bold mb-0" style="font-size: 0.9rem;">{{ $table->table_number }}</span>
            <small class="d-block text-muted" style="font-size: 0.7rem;">{{ $table->capacity }} Pax</small>
            
            <div class="mt-2">
                @if ($isBooked)
                    <span class="badge rounded-pill bg-secondary" style="font-size: 0.55rem;">FULL</span>
                @else
                    <span class="badge rounded-pill bg-success" style="font-size: 0.55rem;">READY</span>
                @endif
            </div>
        </div>
    </label>
</div>