<?php
/**
 * This is an easy to use wp framework to speed the process of writting wordpress plugin and the structure layout of your plugin
 * This plugin is licensed under GPL and can be used in both personal and commercial applications.
 * it may however not be sold individually!!
 *
 * @author uWebic
 * */

class WP_elements {

    public function __construct() {
        
    }

    /**
     * openWrapper function
     *
     * @return string
     * */
    public function openWrapper($pageTitle, $icon = 'themes') {
        $content = '<div class="wrap">
			<div id="icon-' . $icon . '" class="icon32"><br /></div>
			<h2>' . $pageTitle . '</h2>
			<br />';
        return $content;
    }

    /**
     * closeWrapper function
     *
     * @return string
     * */
    public function closeWrapper() {
        $content = '</div>';
        return $content;
    }

    /**
     * function to open a form
     *
     * @return void
     * */
    public function openForm($action = '', $method = 'post', $enctype = false, $id = '') {
        if ($enctype === true) {
            $enc = 'enctype="multipart/form-data"';
        } else {
            $enc = '';
        }
        $content = '<form id="' . $id . '" method="' . $method . '" action ="' . $action . '" ' . $enc . ' >';
        return $content;
    }

    /**
     * function to close a form
     *
     * @return void
     * */
    public function closeForm() {
        $content = '</form>';
        return $content;
    }

    /**
     * function to open table
     *
     * @return void
     * */
    public function openTableWrapper($title, $icon = false, $class = 'options', $columns = 3) {
        if ($icon !== false):
            ?>
            <div class="icon32" id="icon-themes"><br></div>
        <?php endif; ?>
        <h2><?php echo $title; ?></h2>
        <table class="widefat creafolio_options">
            <thead><tr><th colspan="<?php echo $columns; ?>">&nbsp;</th></tr></thead>
            <tbody>
                <?php
            }

            /**
             * function to open table
             *
             * @return void
             * */
            public function closeTableWrapper($columns = 3, $submit = array('btn_name' => 'submit', 'btn_title' => 'Update Options')) {
                ?>
            </tbody>
            <tfoot><tr><th colspan="<?php echo $columns; ?>">&nbsp;</th></tr></tfoot>
        </table>
        <?php if ($submit !== false): ?>
            <p><input type="submit" name="<?php echo $submit['btn_name']; ?>" value="<?php echo $submit['btn_title']; ?>" class="button-primary" /></p>
            <?php
        endif;
    }

    /**
     * loadView function
     *
     * @return void
     * */
    public function loadView($view, $pluginName, $ext = 'php') {
        include($_SERVER['DOCUMENT_ROOT'] . 'wp-content/plugin/' . PLUGIN_NAME . '/views/' . $view . '.' . $ext);
    }

    /**
     * function to send an email
     *
     * @return void
     * */
    public function sendmail($to, $from, $subject, $message) {
        $headers = 'From: ' . $from;
        mail($to, $subject, $message, $headers);
    }

    /**
     * a plugin to set a default value in form fields
     *
     * @return void
     * */
    public function set_value($value, $default_value) {
        if (isset($value) && !empty($value)) {
            return $value;
        } else {
            return $default_value;
        }
    }

    /**
     * a plugin to set a default value in form fields
     *
     * @return void
     * */
    public function set_form_value($name, $default_value) {
        return (array_key_exists($name, $_POST)) ? $_POST[$name] : (isset($default_value)) ? $default_value : '';
    }

    /**
     * public to check if a checkbox is checked. If it is the attribute checked will be returned
     *
     * @return void
     * */
    public function if_checked($value) {
        if ($value == 1 || $value == 'on' || $value == 'checked') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * public to check if a radio is checked
     *
     * @return void
     * */
    public function if_selected($value) {
        if ($value == 1 || $value == 'on' || $value == 'checked' || $value == 'selected') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * function to create a slug for usage in an url for example
     *
     * @return void
     * */
    public function createSlug($slug) {
        if (!empty($slug)):
            $str = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '_', $slug), '_'));
            return $str;
        else:
            return false;
        endif;
    }

    /**
     * function to get file contents
     *
     * @return void
     * */
    public function getFileContent($path) {
        if (!file_exists($path)) {
            throw new exception(__CLASS__ . '::' . __FUNCTION__ . ' - Could not get content from file!');
        }
        $content = file_get_contents($path, FILE_USE_INCLUDE_PATH);
        return $content;
    }

    /**
     * function to load js files (UNFINISHED!!!)
     *
     * @return void
     * */
    public function loadJs($name, $scripts, $pluginName) {
        $name = strtolower($name);
        $jsFolderPath = ABSPATH . 'wp-content/plugins/' . $pluginName . '/js/';
        $js = 'jQuery(document).ready(function($) {';
        if (is_array($scripts)) {
            foreach ($scripts as $key => $script) {
                if ($key == 'link') {
                    try {
                        $js .= self::getFileContent($jsFolderPath . $script);
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                } else {
                    $js .= $script;
                }
            }
        } else {
            throw new exception('Scripts must be passed as an array!');
        }
        $js .= '});';
        //check if file exists
        $dynamicJsPath = $jsFolderPath . 'dynamic/' . $name . '.js';
        $jsFile = get_bloginfo('url') . '/wp-content/plugins/' . $pluginName . '/js/dynamic/' . $name . '.js';
        if (!file_exists($dynamicJsPath)) {
            //write js to file
            if (!$handle = fopen($dynamicJsPath, 'a')) {
                throw new exception('Cannot read ' . $name . '.js cache file');
            }
            if (fwrite($handle, $js) === FALSE) {
                throw new exception('Cannot write to file ' . $name . '.js');
            }
        }
        return $jsFile;
    }

    /**
     * Response with json header
     * @param string $response 
     */
    public function jsonResponseOutput($response) {
        header("Content-Type: application/json");
        echo $response;
        exit;
    }

}