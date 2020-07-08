<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2017
 * @package yii2-mpdf
 * @version 1.0.2
 */

namespace kartik\mpdf;

use Mpdf\Mpdf;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;

/**
 * The Pdf class is a Yii2 component that allows to convert HTML content to portable document format (PDF). It allows
 * configuration of how the PDF document is generated and how it should be delivered to the user. This component uses
 * the [[Mpdf]] library and includes various additional enhancements specifically for the Yii2 framework.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class Pdf extends Component
{
    /**
     * Blank default mode
     */
    const MODE_BLANK = '';
    /**
     * Core fonts mode
     */
    const MODE_CORE = 'c';
    /**
     * Unicode UTF-8 encoded mode
     */
    const MODE_UTF8 = 'UTF-8';
    /**
     * Asian fonts mode
     */
    const MODE_ASIAN = '+aCJK';
    /**
     * A3 page size format
     */
    const FORMAT_A3 = 'A3';
    /**
     * A4 page size format
     */
    const FORMAT_A4 = 'A4';
    /**
     * Letter page size format
     */
    const FORMAT_LETTER = 'Letter';
    /**
     * Legal page size format
     */
    const FORMAT_LEGAL = 'Legal';
    /**
     * Folio page size format
     */
    const FORMAT_FOLIO = 'Folio';
    /**
     * Ledger page size format
     */
    const FORMAT_LEDGER = 'Ledger-L';
    /**
     * Tabloid page size format
     */
    const FORMAT_TABLOID = 'Tabloid';
    /**
     * Portrait orientation
     */
    const ORIENT_PORTRAIT = 'P';
    /**
     * Landscape orientation
     */
    const ORIENT_LANDSCAPE = 'L';
    /**
     * File output sent to browser inline
     */
    const DEST_BROWSER = 'I';
    /**
     * File output sent for direct download
     */
    const DEST_DOWNLOAD = 'D';
    /**
     * File output sent to a file
     */
    const DEST_FILE = 'F';
    /**
     * File output sent as a string
     */
    const DEST_STRING = 'S';
    /**
     * @var string specifies the mode of the new document. If the mode is set by passing a country/language string,
     * this may also set: available fonts, text justification, and directionality RTL.
     */
    public $mode = self::MODE_BLANK;
    /**
     * @var string|array, the format can be specified either as a pre-defined page size, or as an array of width and
     * height in millimetres.
     */
    public $format = self::FORMAT_A4;
    /**
     * @var integer sets the default document font size in points (pt)
     */
    public $defaultFontSize = 0;
    /**
     * @var string sets the default font-family for the new document. Uses default value set in defaultCSS
     * unless codepage has been set to "win-1252". If codepage="win-1252", the appropriate core Adobe font
     * will be set i.e. Helvetica, Times, or Courier.
     */
    public $defaultFont = '';
    /**
     * @var float sets the page left margin for the new document. All values should be specified as LENGTH in
     * millimetres. If you are creating a DOUBLE-SIDED document, the margin values specified will be used for
     * ODD pages; left and right margins will be mirrored for EVEN pages.
     */
    public $marginLeft = 10;
    /**
     * @var float sets the page right margin for the new document (in millimetres).
     */
    public $marginRight = 10;
    /**
     * @var float sets the page top margin for the new document (in millimetres).
     */
    public $marginTop = 16;
    /**
     * @var float sets the page bottom margin for the new document (in millimetres).
     */
    public $marginBottom = 16;
    /**
     * @var float sets the page header margin for the new document (in millimetres).
     */
    public $marginHeader = 9;
    /**
     * @var float sets the page footer margin for the new document (in millimetres).
     */
    public $marginFooter = 9;
    /**
     * @var string specifies the default page orientation of the new document.
     */
    public $orientation = self::ORIENT_PORTRAIT;
    /**
     * @var string css file to prepend to the PDF
     */
    public $cssFile = '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css';
    /**
     * @var string additional inline css to append after the cssFile
     */
    public $cssInline = '';
    /**
     * @var string the HTML content to be converted to PDF
     */
    public $content = '';
    /**
     * @var string the output filename
     */
    public $filename = '';
    /**
     * @var string the output destination
     */
    public $destination = self::DEST_BROWSER;
    /**
     * @var string the folder path for storing the temporary data generated by mpdf.
     * If not set this defaults to path `Yii::getAlias('@runtime/mpdf')` which will be created if it does not exist.
     */
    public $tempPath;
    /**
     * @var array the Mpdf methods that will called in the sequence listed before rendering the content. Should be an
     * associative array entered as `$method => $params` pairs, where:
     * - `$method`: _string_, is the Mpdf method / function name
     * - `$param`: _mixed_, are the Mpdf method parameters
     */
    public $methods = '';
    /**
     * @var array the Mpdf configuration options entered as `$key => value` pairs, where:
     * - `$key`: _string_, is the configuration property name
     * - `$value`: _mixed_, is the configured property value
     */
    public $options = [
        'autoScriptToLang' => true,
        'ignore_invalid_utf8' => true,
        'tabSpaces' => 4,
    ];
    /**
     * @var Mpdf api instance
     */
    protected $_mpdf;
    /**
     * @var string the css file content
     */
    protected $_css;
    /**
     *
     * @var array list of file paths that should be attached to the generated PDF
     */
    protected $_pdfAttachments;

    /**
     * Defines a Mpdf temporary path if not set.
     *
     * @param string $prop the Mpdf constant to define
     * @param string $dir the directory to create
     *
     * @throws InvalidConfigException
     */
    protected static function definePath($prop, $dir)
    {
        if (defined($prop)) {
            $propDir = constant($prop);
            if (is_writable($propDir)) {
                return;
            }
        }
        $status = true;
        if (!is_dir($dir)) {
            $status = mkdir($dir, 0777, true);
        }
        if (!$status) {
            throw new InvalidConfigException("Could not create the folder '{$dir}' in '\$tempPath' set.");
        }
        define($prop, $dir);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->initTempPaths();
        parent::init();
        $this->parseFormat();
    }

    /**
     * Initialize folder paths to allow [[Mpdf]] to write temporary data.
     *
     * @throws InvalidConfigException
     */
    public function initTempPaths()
    {
        if (empty($this->tempPath)) {
            $this->tempPath = Yii::getAlias('@runtime/mpdf');
        }
        $s = DIRECTORY_SEPARATOR;
        $prefix = $this->tempPath . $s;
        static::definePath('_MPDF_TEMP_PATH', "{$prefix}tmp{$s}");
        static::definePath('_MPDF_TTFONTDATAPATH', "{$prefix}ttfontdata{$s}");
    }

    /**
     * Renders and returns the PDF output. Uses the class level property settings.
     *
     * @return mixed
     */
    public function render()
    {
        if (!empty($this->methods)) {
            foreach ($this->methods as $method => $param) {
                $this->execute($method, $param);
            }
        }
        return $this->output($this->content, $this->filename, $this->destination);
    }

    /**
     * Validates and fetches the Mpdf API instance.
     *
     * @return Mpdf
     */
    public function getApi()
    {
        if (empty($this->_mpdf) || !$this->_mpdf instanceof Mpdf) {
            $this->setApi();
        }
        return $this->_mpdf;
    }

    /**
     * Sets the Mpdf API instance
     */
    public function setApi()
    {
        $this->options['mode'] = $this->mode;
        $this->options['format'] = $this->format;
        $this->options['default_font_size'] = $this->defaultFontSize;
        $this->options['default_font'] = $this->defaultFont;
        $this->options['margin_left'] = $this->marginLeft;
        $this->options['margin_right'] = $this->marginRight;
        $this->options['margin_top'] = $this->marginTop;
        $this->options['margin_bottom'] = $this->marginBottom;
        $this->options['margin_header'] = $this->marginHeader;
        $this->options['margin_footer'] = $this->marginFooter;
        $this->options['orientation'] = $this->orientation;
        if (isset($this->tempPath) && is_dir($this->tempPath)) {
            $this->options['tempDir'] = $this->tempPath;
        }
        $this->_mpdf = new Mpdf($this->options);
    }

    /**
     * Fetches the content of the CSS file if supplied
     *
     * @return string
     */
    public function getCss()
    {
        if (!empty($this->_css)) {
            return $this->_css;
        }
        $cssFile = empty($this->cssFile) ? '' : Yii::getAlias($this->cssFile);
        if (empty($cssFile) || !file_exists($cssFile)) {
            $css = '';
        } else {
            $css = file_get_contents($cssFile);
        }
        $css .= $this->cssInline;
        return $css;
    }

    /**
     * Gets the list of currently attached PDF attachments.
     *
     * @return array
     */
    public function getPdfAttachments()
    {
        return $this->_pdfAttachments;
    }

    /**
     * Adds a PDF attachment to the generated PDF
     *
     * @param string $filePath
     */
    public function addPdfAttachment($filePath)
    {
        $this->_pdfAttachments[] = $filePath;
    }

    /**
     * Calls the Mpdf method with parameters
     *
     * @param string $method the Mpdf method / function name
     * @param array  $params the Mpdf parameters
     *
     * @return mixed
     * @throws InvalidParamException
     */
    public function execute($method, $params = [])
    {
        $api = $this->getApi();
        if (!method_exists($api, $method)) {
            throw new InvalidParamException("Invalid or undefined Mpdf method '{$method}' passed to 'Pdf::execute'.");
        }
        if (!is_array($params)) {
            $params = [$params];
        }
        return call_user_func_array([$api, $method], $params);
    }

    /**
     * Generates a PDF output
     *
     * @param string $content the input HTML content
     * @param string $file the name of the file. If not specified, the document will be sent to the browser inline
     * (i.e. [[DEST_BROWSER]]).
     * @param string $dest the output destination. Defaults to [[DEST_BROWSER]].
     *
     * @return mixed
     */
    public function output($content = '', $file = '', $dest = self::DEST_BROWSER)
    {
        $api = $this->getApi();
        $css = $this->getCss();
        $pdfAttachments = $this->getPdfAttachments();
        if (!empty($css)) {
            $api->WriteHTML($css, 1);
            $api->WriteHTML($content, 2);
        } else {
            $api->WriteHTML($content);
        }

        if ($pdfAttachments) {
            $api->SetImportUse();
            $api->SetHeader(null);
            $api->SetFooter(null);
            foreach ($pdfAttachments as $attachment) {
                $this->writePdfAttachment($api, $attachment);
            }
        }
        return $api->Output($file, $dest);
    }

    /**
     * Parse the format automatically based on the orientation
     */
    protected function parseFormat()
    {
        $landscape = self::ORIENT_LANDSCAPE;
        $tag = '-' . $landscape;
        if ($this->orientation == $landscape && is_string($this->format) && substr($this->format, -2) != $tag) {
            $this->format .= $tag;
        }
    }

    /**
     * Appends the given attachment to the generated PDF
     *
     * @param Mpdf   $api the Mpdf API instance
     * @param string $attachment the attachment name
     */
    private function writePdfAttachment($api, $attachment)
    {
        $pageCount = $api->SetSourceFile($attachment);
        for ($i = 1; $i <= $pageCount; $i++) {
            $api->AddPage();
            $templateId = $api->ImportPage($i);
            $api->UseTemplate($templateId);
        }
    }
}
