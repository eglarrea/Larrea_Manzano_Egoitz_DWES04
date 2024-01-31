<?php
abstract class Dto implements JsonSerializable{
    public function jsonSerialize() {
        $arr = get_object_vars( $this );
        return $arr;
    }
}
?>