(function($) {
    function getAddToCartUrl() {
        var base = $('base').attr('href');
        if (!base) {
            base = window.APP_BASE_PATH || '/';
        }
        if (base.slice(-1) !== '/') {
            base += '/';
        }
        return base + 'ajax/add-to-cart.php';
    }

    function showCartToast(message, isError) {
        var $toast = isError ? $('#cart-error-toast') : $('#cart-add-toast');
        var $body = isError ? $('#cart-error-toast-body') : $('#cart-add-toast-body');
        if (!$toast.length || !$body.length) {
            return;
        }
        $body.text(message);
        $toast.toast({ delay: isError ? 4000 : 3000 });
        $toast.toast('show');
    }

    function updateCartBadge(count) {
        $('#header-cart-count').text(count);
    }

    var clickedBuyNow = false;

    $(document).on('click', '.js-add-to-cart-form [type="submit"]', function() {
        clickedBuyNow = $(this).is('[data-buy-now]');
    });

    $(document).on('submit', '.js-add-to-cart-form', function(e) {
        e.preventDefault();

        var $form = $(this);
        var buyNow = clickedBuyNow;
        clickedBuyNow = false;

        var formData = $form.serializeArray();
        var hasAddFlag = false;
        $.each(formData, function(_, field) {
            if (field.name === 'add_to_cart') {
                hasAddFlag = true;
            }
        });
        if (!hasAddFlag) {
            formData.push({ name: 'add_to_cart', value: '1' });
        }

        $form.find('[type="submit"]').prop('disabled', true);

        $.ajax({
            url: getAddToCartUrl(),
            method: 'POST',
            data: $.param(formData),
            dataType: 'json'
        }).done(function(res) {
            if (res && res.success === true) {
                var qty = res.quantity || 1;
                var name = res.product_name || 'sản phẩm';
                showCartToast('Bạn đã thêm ' + qty + ' ' + name + ' vào giỏ hàng.', false);
                if (typeof res.cart_count !== 'undefined') {
                    updateCartBadge(res.cart_count);
                }
                if (buyNow) {
                    window.location.href = ($('base').attr('href') || '') + 'index.php?url=thanh-toan';
                }
            } else {
                showCartToast((res && res.message) ? res.message : 'Không thể thêm vào giỏ hàng', true);
                if (res && res.login_required) {
                    window.location.href = ($('base').attr('href') || '') + 'index.php?url=dang-nhap';
                }
            }
        }).fail(function(xhr) {
            var message = 'Không thể thêm vào giỏ hàng. Vui lòng thử lại.';
            if (xhr.responseText) {
                try {
                    var parsed = JSON.parse(xhr.responseText);
                    if (parsed && parsed.message) {
                        message = parsed.message;
                    }
                } catch (err) {
                    /* response không phải JSON */
                }
            }
            showCartToast(message, true);
        }).always(function() {
            $form.find('[type="submit"]').prop('disabled', false);
        });
    });
})(jQuery);
