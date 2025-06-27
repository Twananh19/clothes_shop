<!DOCTYPE html>
<html>
   <head>
      @include('admin.css')
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <style type="text/css">
         .order_table {
            border: 2px solid white;
            margin: auto;
            width: 95%;
            text-align: center;
            margin-top: 20px;
         }
         .order_table th {
            background-color: skyblue;
            color: white;
            font-size: 19px;
            font-weight: bold;
            padding: 15px;
         }
         .order_table td {
            color: white;
            padding: 10px;
            border: 1px solid skyblue;
         }
         .order_table tr:nth-child(even) {
            background-color: #2c3e50;
         }
         .order_table tr:nth-child(odd) {
            background-color: #34495e;
         }
         .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
            margin: 2px;
         }
         .order-items {
            max-width: 300px;
            word-wrap: break-word;
         }
         .order-status {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
         }
         .status-completed {
            background-color: #28a745;
            color: white;
         }
         .status-pending {
            background-color: #ffc107;
            color: black;
         }
         .status-failed {
            background-color: #dc3545;
            color: white;
         }
         .order-total {
            font-weight: bold;
            color: #28a745;
         }
         .filters {
            margin: 20px auto;
            width: 95%;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
         }
         .filters label {
            color: #333;
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
         }
         .filters .form-control {
            padding: 8px 12px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 14px;
         }
         .filters .btn {
            padding: 8px 20px;
            border-radius: 5px;
            font-weight: 600;
         }
      </style>
   </head>
   <body>
      @include('admin.header')
      @include('admin.sidebar')

      <div class="page-content">
         <div class="page-header">
            <div class="container-fluid">
               <h2 class="h5 no-margin-bottom">Order Management</h2>
            </div>
         </div>

         <!-- Filters -->
         <div class="filters">
            <form method="GET" action="{{ url('admin/orders') }}">
               <div class="row">
                  <div class="col-md-2">
                     <label for="status">Status:</label>
                     <select name="status" id="status" class="form-control" onchange="this.form.submit()">
                        <option value="">All Status</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                     </select>
                  </div>
                  <div class="col-md-2">
                     <label for="date_from">From Date:</label>
                     <input type="date" name="date_from" id="date_from" class="form-control" value="{{ request('date_from') }}" onchange="this.form.submit()">
                  </div>
                  <div class="col-md-2">
                     <label for="date_to">To Date:</label>
                     <input type="date" name="date_to" id="date_to" class="form-control" value="{{ request('date_to') }}" onchange="this.form.submit()">
                  </div>
                  <div class="col-md-3">
                     <label for="search">Search Customer:</label>
                     <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" placeholder="Enter customer name or email">
                  </div>
                  <div class="col-md-3" style="display: flex; align-items: flex-end;">
                     <button type="submit" class="btn btn-primary mr-2">Search</button>
                     <a href="{{ url('admin/orders') }}" class="btn btn-secondary">Clear</a>
                  </div>
               </div>
            </form>
         </div>

         @if(session()->has('success'))
         <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session()->get('success') }}
         </div>
         @endif

         <div class="container-fluid">
            <div class="div_deg">
               <table class="order_table">
                  <tr>
                     <th>Order ID</th>
                     <th>Customer Info</th>
                     <th>Total Amount</th>
                     <th>Payment Status</th>
                     <th>Order Items</th>
                     <th>Order Date</th>
                     <th>Actions</th>
                  </tr>

                  @foreach($orders as $order)
                  <tr>
                     <td>#{{ $order->id }}</td>
                     <td>
                        <strong>{{ $order->customer_name }}</strong><br>
                        <small>{{ $order->customer_email }}</small><br>
                        <small>{{ $order->customer_phone }}</small><br>
                        <small>{{ $order->customer_address }}</small>
                     </td>
                     <td class="order-total">${{ number_format($order->total_amount, 2) }}</td>
                     <td>
                        <span class="order-status status-{{ $order->payment_status }}">
                           {{ ucfirst($order->payment_status) }}
                        </span>
                     </td>
                     <td class="order-items">
                        @if(is_array($order->order_items))
                           @foreach($order->order_items as $item)
                              <div style="margin-bottom: 5px; padding: 5px; background-color: rgba(255,255,255,0.1); border-radius: 3px;">
                                 <strong>{{ $item['title'] ?? 'Unknown Product' }}</strong><br>
                                 <small>Qty: {{ $item['quantity'] ?? 0 }} × ${{ number_format($item['price'] ?? 0, 2) }}</small>
                                 @if(isset($item['discount']) && $item['discount'] > 0)
                                    <br><small class="text-warning">Discount: {{ $item['discount'] }}%</small>
                                 @endif
                              </div>
                           @endforeach
                        @else
                           <small>No items data</small>
                        @endif
                     </td>
                     <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                     <td>
                        <button class="btn btn-info btn-sm" onclick="viewOrder({{ $order->id }})">
                           <i class="fa fa-eye"></i> View
                        </button>
                        @if($order->payment_status == 'pending')
                        <button class="btn btn-success btn-sm" onclick="updateStatus({{ $order->id }}, 'completed')">
                           <i class="fa fa-check"></i> Mark Completed
                        </button>
                        @endif
                        <button class="btn btn-danger btn-sm" onclick="deleteOrder({{ $order->id }})">
                           <i class="fa fa-trash"></i> Delete
                        </button>
                     </td>
                  </tr>
                  @endforeach
               </table>

               @if($orders->count() == 0)
               <div style="text-align: center; color: white; margin-top: 50px;">
                  <h3>No orders found</h3>
                  <p>There are no orders matching your criteria.</p>
               </div>
               @endif

               <!-- Pagination -->
               <div style="margin-top: 20px; text-align: center;">
                  {{ $orders->appends(request()->query())->links() }}
               </div>
            </div>
         </div>
      </div>

      <!-- Order Details Modal -->
      <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: #2c3e50; color: white;">
               <div class="modal-header">
                  <h5 class="modal-title" id="orderModalLabel">Order Details</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body" id="orderDetails">
                  <!-- Order details will be loaded here -->
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>

      @include('admin.js')
      <!-- Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
      
      <script>
         function viewOrder(orderId) {
            // Load order details via AJAX
            $.get('{{ url("admin/order-details") }}/' + orderId, function(data) {
               $('#orderDetails').html(data);
               var orderModal = new bootstrap.Modal(document.getElementById('orderModal'));
               orderModal.show();
            }).fail(function() {
               alert('Failed to load order details');
            });
         }

         function updateStatus(orderId, status) {
            if(confirm('Are you sure you want to update this order status?')) {
               $.post('{{ url("admin/ajax-update-order-status") }}', {
                  order_id: orderId,
                  status: status,
                  _token: '{{ csrf_token() }}'
               }).done(function(response) {
                  if(response.success) {
                     location.reload();
                  } else {
                     alert('Failed to update status');
                  }
               }).fail(function() {
                  alert('Failed to update status');
               });
            }
         }

         function deleteOrder(orderId) {
            if(confirm('Are you sure you want to delete this order? This action cannot be undone.')) {
               $.post('{{ url("admin/ajax-delete-order") }}', {
                  order_id: orderId,
                  _token: '{{ csrf_token() }}'
               }).done(function(response) {
                  if(response.success) {
                     location.reload();
                  } else {
                     alert('Failed to delete order');
                  }
               }).fail(function() {
                  alert('Failed to delete order');
               });
            }
         }
      </script>
   </body>
</html>
