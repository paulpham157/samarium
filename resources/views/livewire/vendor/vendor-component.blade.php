<div>
  
  <x-base-component moduleName="Vendor">

    {{--
    |
    | Toolbar.
    |
    --}}

    <x-slot name="toolbar">
      @include ('partials.dashboard.spinner-button')

      @if ($modes['list'] || !array_search(true, $modes))
        @include ('partials.dashboard.tool-bar-button-pill', [
            'btnClickMethod' => "enterMode('create')",
            'btnIconFaClass' => 'fas fa-plus-circle',
            'btnText' => 'New',
            'btnCheckMode' => 'create',
        ])
      @endif

      @if ($modes['list'] || !array_search(true, $modes))
        <x-toolbar-dropdown-component toolbarButtonDropdownId="vendorToolbarDropdown">
          <x-toolbar-dropdown-item-component clickMethod="enterMode('search')">
            Search
          </x-toolbar-dropdown-item-component>
        </x-toolbar-dropdown-button>
      @endif
    </x-slot>

    <div>

      {{--
         |
         | Use required component as per mode
         |
      --}}

      @if ($modes['create'])
        @livewire ('vendor.vendor-create')
      @elseif ($modes['search'])
        @livewire ('vendor.vendor-search')
      @elseif ($modes['display'])
        @livewire ('vendor.vendor-display', ['vendor' => $displayingVendor,])
      @elseif ($modes['list'])
        @livewire ('vendor.vendor-list')
      @else
        @livewire ('vendor.vendor-list')
      @endif
    </div>
  </x-base-component>

</div>
