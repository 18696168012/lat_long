<?php
/** 作者:张宏扬
 * 根据经纬度计算距离
 * 函数和sql语句分别实现
 * 此文件仅作参考,请根据自己的需要,进行相应的更改
 *   */
    //第一种,通过封装函数实现
    /**
     *  @desc 根据两点间的经纬度计算距离
     *  @param float $lat 纬度值
     *  @param float $lng 经度值
     *  @return 米
     */
    function getDistance($lat1, $lng1, $lat2, $lng2){
        $earthRadius = 6367000;
        $lat1 = ($lat1 * pi() ) / 180;
        $lng1 = ($lng1 * pi() ) / 180;
        $lat2 = ($lat2 * pi() ) / 180;
        $lng2 = ($lng2 * pi() ) / 180;
        $calcLongitude = $lng2 - $lng1;
        $calcLatitude = $lat2 - $lat1;
        $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
        $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
        $calculatedDistance = $earthRadius * $stepTwo;
        return round($calculatedDistance);
    }
    //调用,输出千米
    echo getDistance(30.511195,114.345571,30.487192,114.486789)/1000;
    //第二种,通过sql语句实现
    //表的结构
    //id 主键
    //lat 纬度
    //long 经度
    $sql="select round(degrees(acos(sin(radians($lat))*sin(radians(`lat`))+cos(radians($lat))*cos(radians(`lat`))*cos(radians($long-`long`))))*69.09) as distance from lat_long order by distance asc limit 5";
    //说明:传入指定的经纬度,查询数据库,计算距离,并且根据距离排序,可以取出最近或者最远的几条














