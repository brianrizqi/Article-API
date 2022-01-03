<?php
if (!function_exists('json_response')) {
    function json_response($success, $message, $data = null, $code = 200)
    {
        $success = $success == 1 ? true : false;
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}

if (!function_exists('generate_slug')) {
    function generate_slug($text, $type = 'category')
    {
        $slug = \Illuminate\Support\Str::slug($text);
        if ($type != 'category') {
            $slug = $slug . '-' . \Illuminate\Support\Str::random(8);
        }
        return $slug;
    }
}
if (!function_exists('getAttribute')) {
    function getAttribute($request, $field)
    {
        $data = $request->get('data');

        if (isset($data['attributes'][$field])) {
            return $data['attributes'][$field];
        }

        return null;
    }
}

