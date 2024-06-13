<?php

if (!function_exists('parseStringToArray')) {
    /**
     * Преобразует строку JSON или строку, разделенную запятыми, в массив.
     *
     * @param string $inputString Входная строка, которая должна быть преобразована.
     * @return array Преобразованный массив.
     */
    function parseStringToArray($inputString): array
    {
        $resultArray = [];

        if (is_string($inputString)) {
            // Если строка является JSON, декодируем ее
            $resultArray = json_decode($inputString, true);

            if (gettype($resultArray) == 'integer') {
                $resultArray = [$resultArray];
            }

            // Если не удалось декодировать JSON, разделяем строку по запятой
            if ($resultArray === null && json_last_error() !== JSON_ERROR_NONE) {
                $resultArray = explode(',', $inputString);
            }
        }

        // Возвращаем массив строк
        return is_array($resultArray) ? $resultArray : [];
    }
}
