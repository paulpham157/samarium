<div class="mb-2">

  {{--
     |
     | Flash message div
     |
  --}}

  @if (session()->has('errorMessage'))
    @include ('partials.flash-message', [
        'flashMessage' => session('errorMessage'),
    ])
  @endif

  
  {{--
     |
     | Show in bigger screen
     |
  --}}
  <div class="bg-white mb-2-rm px-2 border shadow-sm-rm d-none-rm d-md-block-rm">
    <div class="table-responsive bg-white pt-3 m-0">
      <table class="table table-sm table-bordered m-0">
        @if (false)
        <thead>
          <tr class="bg-white">
            <th class="py-2 border-0" style="width: 200px;">
              <div class="d-flex justify-content-between">
                <div class="d-flex flex-column justify-content-center o-heading">
                  Search Item
                </div>
                <div>
                  <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="searchTypeDropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Select search type
                    </button>
                    <div class="dropdown-menu" aria-labelledby="searchTypeDropdownMenu">
                      <button class="dropdown-item" type="button" wire:click="">Name</button>
                      <button class="dropdown-item" type="button" wire:click="">Barcode</button>
                      <button class="dropdown-item" type="button" wire:click="">Category</button>
                    </div>
                  </div>
                </div>
              </div>
            </th>
            @if (false)
            <th class="py-2">Category</th>
            <th class="py-2">Item</th>
            <th class="py-2" style="width: 100px;">Price</th>
            <th class="py-2" style="width: 50px;">Qty</th>
            <th class="py-2" style="width: 100px;">Total</th>
            @endif
          </tr>
        </thead>
        @endif
        <tbody>
          <tr class="p-0 font-weight-bold" style="height: 50px;">
            <td class="h-100 bg-white p-0 border-0">
              <div class="d-flex">
                <input class="form-control m-0 w-100 h-100 border-0-rm py-2" type="text" style="background-color: #fff;"
                    wire:model="add_item_name" wire:keydown.enter="updateProductList" placeholder="Search product by name" autofocus/>
                <div class="m-0 bg-white py-3-rm">
                  <div class="d-flex">
                    @if (false)
                      <button class="mr-3" wire:click="addItemToSaleInvoice">
                        <i class="fas fa-plus mr-2"></i>
                        Add
                      </button>
                    @endif
                    <button class="btn btn-primary font-weight-bold ml-2 mr-4 h-100" wire:click="updateProductList">
                        Search
                    </button>
                    @if (true)
                    <button class="bg-white border-0 text-primary font-weight-bold mr-4" wire:click="resetInputFields">
                      @if (false)
                      <i class="fas fa-refresh"></i>
                      @endif
                        Reset
                    </button>
                    @endif
                    @include ('partials.dashboard.spinner-button')
                  </div>

                  @if (false && $selectedProduct != null)
                    <div class="d-flex justify-content-end">
                      <div>
                        <img src="{{ asset('storage/' . $selectedProduct->image_path) }}" class="img-fluid" style="height: 50px;">
                      </div>
                    </div>
                  @endif
                </div>
              </div>
            </td>
            @if (false)
            <td class="p-0 h-100">
              <select class="w-100 h-100 custom-control border-0 bg-white" wire:model="search_product_category_id" wire:change="selectProductCategory">
                <option>---</option>
  
                @foreach ($productCategories as $productCategory)
                  <option value="{{ $productCategory->product_category_id }}">
                    {{ $productCategory->name }}
                  </option>
                @endforeach
              </select>
            </td>
            <td class="p-0 h-100">
              <select class="w-100 h-100 custom-control border-0 bg-white" wire:model="product_id" wire:change="selectItem">
                <option>---</option>
                @foreach ($products as $product)
                  <option value="{{ $product->product_id }}">
                    {{ $product->name }}
                  </option>
                @endforeach
              </select>
            </td>
            <td class="p-0">
              <div class="d-flex flex-column justify-content-center h-100 bg-light">
                @if ($selectedProduct)
                  @php echo number_format( $selectedProduct->selling_price ); @endphp
                @endif
              </div>
            </td>
            <td class="p-0 h-100">
              <input class="w-100 h-100 font-weight-bold border-0" type="text" wire:model="quantity" wire:keydown.enter="updateTotal"/>
            </td>
            <td class="p-0">
              <div class="d-flex flex-column justify-content-center h-100 bg-white">
                @if ($selectedProduct)
                  @php echo number_format( $total ); @endphp
                @endif
              </div>
            </td>
            @endif
          </tr>
        </tbody>
      </table>
    </div>

  </div>

  <div class="bg-dark-rm text-muted px-3 py-2 o-package-color">
    <small>
    Add products to the sale invoice
    </small>
  </div>
  <div class="bg-white text-dark px-3 py-2">
    &nbsp;<br/>
    &nbsp;<br/>
    &nbsp;<br/>
    &nbsp;<br/>
    &nbsp;<br/>
    &nbsp;<br/>
  </div>

  @if ($modes['productSelected'])
    <div class="d-flex justify-content-between border p-3 bg-white mb-2" wire:key="{{ rand() }}">
      <div>
        <div class="o-heading">
          Product:
        </div>
        {{ $selectedProduct->name }}
      </div>
      <div class="d-flex">
        <div class="mr-4">
          <div class="o-heading">
            Qty
          </div>
          <input class="font-weight-bold border" type="text" wire:model="quantity" wire:keydown.enter="updateTotal" wire:change="updateTotal" />
        </div>
        <div class="mr-4">
          <div class="o-heading">
            Price per unit
          </div>
          {{ config('app.transaction_currency_symbol') }}
          {{ $selectedProduct->selling_price }}
        </div>
        <div class="mr-4">
          <div class="o-heading">
            Total
          </div>
          @if ($selectedProduct)
            {{ config('app.transaction_currency_symbol') }}
            @php echo number_format( $total ); @endphp
          @endif
        </div>
        <div class="px-3">
          <div class="o-heading">
            Action
          </div>
          <button class="btn btn-primary" wire:click="addItemToSaleInvoice">
            Add
          </button>
          <button class="btn btn-primary" wire:click="resetInputFields">
            Cancel
          </button>
        </div>
      </div>
    </div>
  @else
    @if ($products != null && count($products) > 0)
      <div class="mb-3">
        @foreach ($products as $product)
          <div class="d-flex justify-content-between border p-3 bg-white" wire:key="{{ rand() }}">
            <div>
              {{ $product->name }}
            </div>
            <div class="d-flex">
              @if ($modes['productSelected'])
              <div>
                Qty
                <br />
                <input type="text" />
              </div>
              <div>
                Price per unit
                <br />
                {{ $selectedProduct->selling_price }}
              </div>
              @endif
              <div class="px-3">
                <button class="btn btn-primary" wire:click="selectItemNew({{ $product }})">
                  Select
                </button>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  @endif

  {{--
     |
     | Show in smaller screen
     |
  --}}
  @if (false)
  <div class="d-md-none mb-3">
    @if (! $modes['showMobForm'])
      <button class="btn btn-success ml-3" wire:click="showAddItemFormMob">
        Add item
      </button>
    @else
      <button class="btn btn-danger ml-3" wire:click="hideAddItemFormMob">
        Cancel
      </button>
    @endif

    @include ('partials.dashboard.spinner-button')

    @if ($modes['showMobForm'])
      <div>
        @include ('partials.mob.add-item-form')
      </div>
    @endif
  </div>
  @endif

</div>
