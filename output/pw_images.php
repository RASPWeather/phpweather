<?php

require_once(PHPWEATHER_BASE_DIR . '/output/pw_output.php');

/* Copyright (c) 2002 Raymond van Beek <ray@devolder.nl>.
Licensed under the GPL, see the file COPYING.

Parts of this code are derived from the phpweather.inc code
by Martin Geisler <gimpster@gimpster.com>

Also see

  http://www.gimpster.com/php/phpweather/ or
  http://www.sourceforge.net/projects/phpweather

for updates and further instructions on how to use PHP Weather.
*/

class pw_images extends pw_output {

  var $itime = '';

  // =======================================================================
  // This section contains user configurable items: The user can
  // configure the image filenames to be generated by the script.
  
  // An array to convert the weather group codes to an index of the
  // $images and $n_images array.
  
  var $phenomena_array = array ('#'  => 'None',
                                'TS' => 'Thun',
                                'RA' => 'Rain',
                                'DZ' => 'Rain',
                                'SN' => 'Snow',
                                'SG' => 'Snow',
                                'GR' => 'Hail',
                                'GS' => 'Hail',
                                'PE' => 'Hail',
                                'IC' => 'Hail',
                                'BR' => 'Fog',
                                'FG' => 'Fog');
  
  // An array to convert the cloud coverage codes to an index of the
  // $images and $n_images array.
  
  var $coverage = array ('CLR' => '0',
                         'SKC' => '0',
                         'FEW' => '1',
                         'SCT' => '2',
                         'BKN' => '3',
                         'OVC' => '4',
                         'VV'  => '4');
  
  var $sky_nodata_image = 'sky_nodata.png';
  
  // Define a lot of images for daylight weather-group/cloud
  // condition. It's a 2-dimensional array, indexed by the:
  // - Precipitation (first index)
  // - Cloud coverage (second index).

  var $images = array ('None'  => array ('0' => '0cloud.png',
                                         '1' => '1cloud_norain.png',
                                         '2' => '2cloud_norain.png',
                                         '3' => '3cloud_norain.png',
                                         '4' => '4cloud_norain.png'),
                       '-Rain' => array ('0' => '0cloud.png',
                                         '1' => '1cloud_lightrain.png',
                                         '2' => '2cloud_lightrain.png',
                                         '3' => '3cloud_lightrain.png',
                                         '4' => '4cloud_lightrain.png'),
                       'Rain'  => array ('0' => '0cloud.png',
                                         '1' => '1cloud_modrain.png',
                                         '2' => '2cloud_modrain.png',
                                         '3' => '3cloud_modrain.png',
                                         '4' => '4cloud_modrain.png'),
                       '+Rain' => array ('0' => '0cloud.png',
                                         '1' => '1cloud_heavyrain.png',
                                         '2' => '2cloud_heavyrain.png',
                                         '3' => '3cloud_heavyrain.png',
                                         '4' => '4cloud_heavyrain.png'),
                       '-Snow' => array ('0' => '0cloud.png',
                                         '1' => '2cloud_snow.png',
                                         '2' => '2cloud_snow.png',
                                         '3' => '3cloud_snow.png',
                                         '4' => '4cloud_lightsnow.png'),
                       '+Snow' => array ('0' => '0cloud.png',
                                         '1' => '2cloud_snow.png',
                                         '2' => '2cloud_snow.png',
                                         '3' => '3cloud_snow.png',
                                         '4' => '4cloud_heavysnow.png'),
                       '-Hail' => array ('0' => '0cloud.png',
                                         '1' => '2cloud_hail.png',
                                         '2' => '2cloud_hail.png',
                                         '3' => '3cloud_hail.png',
                                         '4' => '4cloud_lighthail.png'),
                       '+Hail' => array ('0' => '0cloud.png',
                                         '1' => '2cloud_hail.png',
                                         '2' => '2cloud_hail.png',
                                         '3' => '3cloud_hail.png',
                                         '4' => '4cloud_heavyhail.png'),
                       'Thun'  => array ('0' => '0cloud.png',
                                         '1' => '2cloud_thunders.png',
                                         '2' => '2cloud_thunders.png',
                                         '3' => '3cloud_thunders.png',
                                         '4' => '4cloud_thunders.png'),
                       'Fog'   => array ('0' => '0cloud_fog.png',
                                         '1' => '1cloud_fog.png',
                                         '2' => '2cloud_fog.png',
                                         '3' => '3cloud_fog.png',
                                         '4' => '4cloud_fog.png')
                       );

  // Define a lot of images for nigh time weather-group/cloud
  // condition. It has the same structure as the daylight array
  // $images It's a 2-dimensional array, indexed by the:
  // - Precipitation (first index)
  // - Cloud coverage (second index).

  var $n_images = array (
                         'None'   => array ('0' => 'n_0cloud.png',
                                            '1' => 'n_1cloud_norain.png',
                                            '2' => 'n_2cloud_norain.png',
                                            '3' => 'n_3cloud_norain.png',
                                            '4' => '4cloud_norain.png'),
                         '-Rain'  => array ('0' => 'n_0cloud.png',
                                            '1' => 'n_1cloud_lightrain.png',
                                            '2' => 'n_2cloud_lightrain.png',
                                            '3' => 'n_3cloud_lightrain.png',
                                            '4' => '4cloud_lightrain.png'),
                         'Rain'   => array ('0' => 'n_0cloud.png',
                                            '1' => 'n_1cloud_modrain.png',
                                            '2' => 'n_2cloud_modrain.png',
                                            '3' => 'n_3cloud_modrain.png',
                                            '4' => '4cloud_modrain.png'),
                         '+Rain'  => array ('0' => 'n_0cloud.png',
                                            '1' => 'n_1cloud_heavyrain.png',
                                            '2' => 'n_2cloud_heavyrain.png',
                                            '3' => 'n_3cloud_heavyrain.png',
                                            '4' => '4cloud_heavyrain.png'),
                         '-Snow'  => array ('0' => 'n_0cloud.png',
                                            '1' => 'n_2cloud_snow.png',
                                            '2' => 'n_2cloud_snow.png',
                                            '3' => 'n_3cloud_snow.png',
                                            '4' => '4cloud_lightsnow.png'),
                         '+Snow'  => array ('0' => 'n_0cloud.png',
                                            '1' => 'n_2cloud_snow.png',
                                            '2' => 'n_2cloud_snow.png',
                                            '3' => 'n_3cloud_snow.png',
                                            '4' => '4cloud_heavysnow.png'),
                         '-Hail'  => array ('0' => 'n_0cloud.png',
                                            '1' => 'n_2cloud_hail.png',
                                            '2' => 'n_2cloud_hail.png',
                                            '3' => 'n_3cloud_hail.png',
                                            '4' => '4cloud_lighthail.png'),
                         '+Hail'  => array ('0' => 'n_0cloud.png',
                                            '1' => 'n_2cloud_hail.png',
                                            '2' => 'n_2cloud_hail.png',
                                            '3' => 'n_3cloud_hail.png',
                                            '4' => '4cloud_heavyhail.png'),
                         'Thun'   => array ('0' => 'n_0cloud.png',
                                            '1' => 'n_2cloud_thunders.png',
                                            '2' => 'n_2cloud_thunders.png',
                                            '3' => 'n_3cloud_thunders.png',
                                            '4' => '4cloud_thunders.png'),
                         'Fog'    => array ('0' => 'n_0cloud_fog.png',
                                            '1' => 'n_1cloud_fog.png',
                                            '2' => 'n_2cloud_fog.png',
                                            '3' => 'n_3cloud_fog.png',
                                            '4' => '4cloud_fog.png')
                         );
  
  // Define image filenames for:
  // - 16 wind directions,
  // - 'no wind direction data'
  // - variable wind direction (VRB)
  // - calm wind (00000KT), or 'nodir'

  var $wind_dir_images = array (0 => 'nnn.png',
                                1 => 'nne.png',
                                2 => 'ne.png',
                                3 => 'nee.png',
                                4 => 'eee.png',
                                5 => 'see.png',
                                6 => 'se.png',
                                7 => 'sse.png',
                                8 => 'sss.png',
                                9 => 'ssw.png',
                                10 => 'sw.png',
                                11 => 'sww.png',
                                12 => 'www.png',
                                13 => 'nww.png',
                                14 => 'nw.png',
                                15 => 'nnw.png',
                                16 => 'nnn.png');

  var $wind_nodata_image = 'wind_nodata.png';
  var $wind_vrb_image = 'vrb.gif';
  var $wind_nodir_image = 'nodir.png';

  // Define image filenames for:
  // - 'no data' condition,
  // - 'temperature zero or below zero degrees Celcius
  // - 'temperature above zero degrees Celcius
  
  var $temp_nodata_image = 'temp_nodata.png';
  var $temp_low_image  = 'templow.png';
  var $temp_high_image = 'temphigh.png';
  var $temp_windchilled_image = 'tempchilled.png';
  // ======================================================================

  // The wind_speeds array can be used to convert wind speed values in
  // [m/s] to [Bft] (beaufort).

  var $wind_speeds = array (
  'beaufort' => array (0,    1,    2,    3,    4,    5,    
                       6,    7,    8,    9,    10,   11,   12),
  'ms'       => array (0.3,  1.6,  3.4,  5.5,  8.0,  10.8,
                       13.9, 17.2, 20.8, 24.5, 28.5, 32.7, 999));
  // ------------------------------------------------------------------------

  /**
   * Constructs a new image output object.
   *
   * @param   phpweather  The object with the weather.
   * @access  public
   */
  function pw_images($weather, $input = array()) {
    /* We just call the parent constructor. */
    $this->pw_output($weather, $input);
  }


  // The get_sky_image() function takes the processed metar data and
  // returns the sky image filename. The function combines the weather
  // group and cloud group to a specific image. Example html code:
  //
  // <img src="< ?php
  //   get_image($processed_metar)
  // ? >" height="50" width="80" border="1">

  function get_sky_image() {
    $processed_metar_data = $this->weather->decode_metar();

    $metar = $processed_metar_data['metar'];

    $parts = explode(' ', $metar);
    $num_parts = count($parts);
    $night = 0;
    $maxcoverage = 0;

    for ($i = 0; $i < $num_parts; $i++) {
      $part = $parts[$i];
    
      if (ereg('RMK|TEMPO|BECMG', $part)) {
        /* The rest of the METAR is either a remark or temporary
         information. We skip the rest of the METAR. */
        break;
      } elseif (ereg('([0-9]{2})([0-9]{2})([0-9]{2})Z', $part, $regs)) {
        if (($regs[2] < 6) || ($regs[2] > 18)) {
          $night = 1;
        }
      }
      elseif (ereg('^(-|\+|VC)?(TS|SH|FZ|BL|DR|MI|BC|PR|RA|DZ|SN|SG|GR|GS|PE|IC|UP|BR|FG|FU|VA|DU|SA|HZ|PY|PO|SQ|FC|SS|DS)+$', $part)) {
        /*
         * Is this the current weather group?
         */ 

        // Get the intensity and get rid of it in the $part string
        $intensity = '';      
        if (ereg('^(-|\+|VC)(..)*$',$part)) {
          if ($part[0] == '-') {
            $intensity = '-';
            $part = substr($part,1);
          } elseif ($part[0] == '+') {
            $intensity = '+';
            $part = substr($part,1);
          } elseif ($part[0] . $part[1] == 'VC') {
            $intensity = '';
            $part = substr($part,2);
          }
        }

      
        // Now, take only the precipitation types that have images.
        // Ignore the others In case more then one exist, take only the
        // first one (highest predominance).
        ereg('(TS|RA|DZ|SN|SG|GR|GS|PE|IC|BR|FG)(..)*$',$part,$match);
        if (!empty($match[1])) {
          $phenomena = $match[1];
        } else {
          ereg('(..)(TS|RA|DZ|SN|SG|GR|GS|PE|IC|BR|FG)(..)*$',$part,$match);
          if (!empty($match[2])) {
            $phenomena = $match[2];
          } else {
            $phenomena = '#'; // No phenomena.
          }
        }
        // Not each precipitation type has a single image with it.
        // Combine similar precipitation types to a phenomena group.
        // I.e. drizzle (DZ) and rain (RA) are both considered to be
        // rain (as far as the images are concerned). Add intensity only
        // in case of rain and snow.
        if (ereg('^(Snow|Hail)$',$this->phenomena_array[$phenomena])) {
          if ($intensity == '') {
            $intensity = '-';
          }
        }
            
        if (ereg('^(Rain|Snow|Hail)$',$this->phenomena_array[$phenomena])) {
          $phenomena_group = $intensity . $this->phenomena_array[$phenomena];
        } else {
          $phenomena_group = $this->phenomena_array[$phenomena];
        }	

      }   
				
      // Now check the cloud coverage. There could be three cloud
      // layers, so check for all of them. Iconize the most covered
      // clouds, thus find the highest cloudcoverage layer, by
      // maximizing the $maxcoverage param
      
      elseif (ereg('(SKC|CLR)(...)', $part, $regs)) {
        $maxcoverage = max($maxcoverage,$this->coverage[$regs[1]]);
        //      if ($maxcoverage < $this->coverage[$regs[1]]) {
        //        $maxcoverage = $this->coverage[$regs[1]];
        //      }
      }
      elseif (ereg('^(VV|FEW|SCT|BKN|OVC)([0-9]{3})(CB|TCU)?$', $part, $regs)) {
        $maxcoverage = max($maxcoverage,$this->coverage[$regs[1]]);
        //      if ($maxcoverage < $this->coverage[$regs[1]]) {
        //        $maxcoverage = $this->coverage[$regs[1]];
        //      }
      }
    }
    // If looped through all groups and not found any weather group
    // (meaning no precipitation?), assume a '#' phenomena, resulting in
    // a 'None' phenomena group
    if (empty($phenomena)) {
      $phenomena = '#';
      $phenomena_group = $this->phenomena_array[$phenomena];
    }
         
    // At this point, the $phenomena_group variable contains the one
    // index of the $this->images array, while the $maxcoverage
    // variable contains the other index of the $this->images array.
    // The correct image can be selected from the array.

    if (($night == 1) || ($this->itime == 'nite')) {
      return $this->properties['icons_path'] .
        $this->n_images[$phenomena_group][$maxcoverage];
    } else { 
      return $this->properties['icons_path'] .
        $this->images[$phenomena_group][$maxcoverage];
    }
  
  }
  // ------------------------------------------------------------------------

  // The get_winddir_image() function takes the processed metar data and
  // returns the appropriate wind direction image filename. There are 16
  // wind direction icons defined to indicate the wind direction. Beside
  // the 16 directions, there are icons for variable wind direction,
  // calm wind and and an icon for the no data condition. Example html
  // code:
  //
  // <img src="< ?php
  //   get_winddir_image($processed_metar)
  // ? >" height="40" width="40" border="1">

  function get_winddir_image() {
    $processed_metar_data = $this->weather->decode_metar();

    if (!empty($processed_metar_data['wind'])) {
      $wind = $processed_metar_data['wind'];
      if ($wind['deg'] == 'VRB') {
        return $this->properties['icons_path'] . $this->wind_vrb_image;
      } elseif (($wind['deg'] == 0) && ($wind['knots'] == 0)) {
        return $this->properties['icons_path'] . $this->wind_nodir_image;
      } else {
        if ($this->properties['reverse_dir']) {
          return $this->properties['icons_path'] .
            $this->wind_dir_images[round($wind['deg']/22.5 + 8) % 16];
        } else {
          return $this->properties['icons_path'] .
            $this->wind_dir_images[round($wind['deg']/22.5)];
        }
      }
    } else {
      return $this->properties['icons_path'] . $this->wind_nodata_image;
    }
  }
  // ------------------------------------------------------------------------

  // The get_temp_image() function takes the processed metar data and
  // returns the appropriate temperature image filename. It uses the
  // 'temp_c' value to decide weather a freezing thermometer icon or a
  // non-freezing thermometer icon. When the 'temp_c' data is not
  // available, a 'no data' icon filename is returned. Example html
  // code:
  //
  // <img src="< ?php
  //   get_temp_image($processed_metar)
  // ? >" height="50" width="20" border="1">

  function get_temp_image() {
    $processed_metar_data = $this->weather->decode_metar();

    if (!empty($processed_metar_data['temperature'])) {
      if (!empty($processed_metar_data['windchill'])) {
        return $this->properties['icons_path'] . $this->temp_windchilled_image;      
      } elseif ($processed_metar_data['temperature']['temp_c'] > 0) {
        return $this->properties['icons_path'] . $this->temp_high_image;
      } else {
        return $this->properties['icons_path'] . $this->temp_low_image;
      }
    } else {
      return $this->properties['icons_path'] . $this->temp_nodata_image;
    }
  }
  // ------------------------------------------------------------------------

  // The get_beaufort() function takes the 'wind_meters_per_second'
  // value from the $decoded_metar array and converts it to beaufort
  // values. This is done by iterating through a table with windspeeds
  // in [m/s] and [bft] values.

  function get_beaufort() {
    $processed_metar_data = $this->weather->decode_metar();

    if (!empty($processed_metar_data['wind'])) {
      $ms = $processed_metar_data['wind']['meters_per_second'];
      $cnt = 0;
      while (($ms > $wind_speeds['ms'][$cnt]) && ($cnt <= 12)) {
        $cnt++;
      }
      return $cnt;
    } else {
      return 0;
    }
  }
  // ------------------------------------------------------------------------

  // The set_time() function is purely added for overruling the metar
  // time to night time. It is only intended to support displaying all
  // weathergroup icons in the table.php script during daytime.

  function set_time($ntime) {
    $this->itime = $ntime;
  }
  // ------------------------------------------------------------------------
  
}

?>
