<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новий відгук</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; line-height: 1.6; color: #1c1917; max-width: 600px; margin: 0 auto; padding: 20px;">

    <div style="background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%); padding: 24px; border-radius: 16px 16px 0 0;">
        <h1 style="color: white; margin: 0; font-size: 24px;">
            {{ str_repeat('⭐', $review->rating) }} Новий відгук!
        </h1>
    </div>

    <div style="background: #fafaf9; border: 1px solid #e7e5e4; border-top: none; padding: 24px; border-radius: 0 0 16px 16px;">

        <div style="display: flex; align-items: center; margin-bottom: 20px;">
            <img src="{{ $review->gravatar_url }}"
                 alt="{{ $review->first_name }}"
                 style="width: 56px; height: 56px; border-radius: 50%; margin-right: 16px; border: 2px solid #e7e5e4;">
            <div>
                <h2 style="margin: 0; color: #1c1917; font-size: 18px;">
                    {{ $review->first_name }} {{ $review->last_name }}
                </h2>
                <p style="margin: 4px 0 0 0; font-size: 14px; color: #78716c;">
                    {{ $review->user->email }}
                    @if($review->instagram)
                        · <a href="https://instagram.com/{{ ltrim($review->instagram, '@') }}" style="color: #f59e0b;">{{ $review->instagram_handle }}</a>
                    @endif
                </p>
            </div>
        </div>

        <div style="margin-bottom: 16px;">
            @for($i = 1; $i <= 5; $i++)
                <span style="font-size: 24px; color: {{ $i <= $review->rating ? '#f59e0b' : '#d6d3d1' }};">★</span>
            @endfor
            <span style="margin-left: 8px; font-size: 14px; color: #78716c; font-weight: 600;">{{ $review->rating }}/5</span>
        </div>

        <div style="background: white; border: 1px solid #e7e5e4; border-radius: 12px; padding: 16px; margin-bottom: 20px;">
            <p style="margin: 0; white-space: pre-wrap; color: #44403c; font-size: 15px;">{{ $review->text }}</p>
        </div>

        <div style="border-top: 1px solid #e7e5e4; padding-top: 16px; margin-top: 16px;">
            <p style="margin: 0 0 8px 0; font-size: 14px; color: #78716c;">
                <strong>Дата:</strong> {{ $review->created_at->format('d.m.Y H:i') }}
            </p>
            <p style="margin: 0; font-size: 14px; color: #dc2626; font-weight: 600;">
                ⏳ Очікує модерації (is_approved = false)
            </p>
        </div>

        <div style="margin-top: 24px; padding: 16px; background: #fef3c7; border-radius: 12px; border: 1px solid #fcd34d;">
            <p style="margin: 0; font-size: 14px; color: #92400e;">
                <strong>Щоб схвалити:</strong><br>
                UPDATE reviews SET is_approved = 1 WHERE id = {{ $review->id }};
            </p>
        </div>

    </div>

    <p style="text-align: center; font-size: 12px; color: #a8a29e; margin-top: 24px;">
        Calorize Reviews
    </p>

</body>
</html>
