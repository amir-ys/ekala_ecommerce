<div class="modal fade" id="order-{{ $order->id }}"
     tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-header"> لیست سفارشات
        </div>
        <div class="modal-content">
            <table id="table" class="table">
                <thead>
                <tr>
                    <th> نام محصول</th>
                    <th> عکس</th>
                    <th> قیمت</th>
                    <th> تعداد</th>
                    <th> قیمت نهایی</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->items as $orderItem)
                    <tr>
                        <td>
                            <a href="{{ $orderItem->product->path() }}">
                                {{ $orderItem->product->name }}
                            </a>
                        </td>
                        <td>
                            <img width="50px" src="{{ route('image.display' , [ 'image' => $orderItem->product->primaryImage->name]) }}" alt="">
                        </td>
                        <td> {{ $orderItem->price }} </td>
                        <td> {{ $orderItem->quantity }} </td>
                        <td> {{ $orderItem->total }} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
