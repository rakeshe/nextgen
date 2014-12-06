<?php
/**
 *
 * @package    prepare_build.php
 * @author     Rakesh Shrestha
 * @since      25/06/14 3:41 PM
 * @version    1.0
 */

/**
 * [x] Update build version in gradle
 * [x] remove cached files
 * [ ] run db migration
 */
class builder
{
    const APP_PATH               = 'src/main/webapp';
    const APP_CACHE_PATH         = 'data/volt';
    const BOOTSTRAP_FILE         = null;
    const APP_CONFIG_PATH        = 'src/main/webapp/config';
    const GRADLE_PROPERTIES_FILE = 'gradle.properties';
    const APP_PROPERTIES_FILE    = 'version.ini';
//    const CONFIG_FILE            = 'global.config.php';
    const GRADLE_GROUP           = 'com.orbitz.host';

    const BIN_PATH               = 'src/main/bin';
    const LIFE_CYCLE_PLUGIN_FILE = 'plugin.ini';

    protected $mini;
    protected $minor;
    protected $major;
    protected $gradleProperty;
    protected $cliParams;
    protected $buildType;

    public $cacheContainer = ['Cache', 'Data', 'Logs', 'Temp'];

    public function __construct($cliParams = null)
    {
        $this->setCliParams($cliParams);
        $this->build();

    }

    /**
     * @param mixed $gradleProperty
     */
    public function setGradleProperty($gradleProperty = null)
    {
        if (null === $gradleProperty) {
            $gradleProperty = parse_ini_file(self::GRADLE_PROPERTIES_FILE);
        }
        $this->gradleProperty = $gradleProperty;
        $this->setVersions($gradleProperty['version']);

    }

    protected function setVersions($version)
    {
        $version = explode('.', $version);
        $this->setMajor($version[0]);
        $this->setMinor($version[1]);
        if (!empty($version[2])) {
            $this->setMini($version[2]);
        }
        $versionText = $this->major;
        $versionText .= !empty($this->minor) ? '.' . $this->minor : '';
        $versionText .= !empty($this->mini) ? '.' . $this->mini : '';
        $this->gradleProperty['version'] = $versionText;
    }

    /**
     * @return mixed
     */
    public function getGradleProperty()
    {
        if (null === $this->gradleProperty) {
            $this->setGradleProperty();
        }
        return $this->gradleProperty;
    }


    /**
     * @param mixed $major
     */
    public function setMajor($major)
    {
        $this->major = $major;
    }

    /**
     * @return mixed
     */
    public function getMajor()
    {
        return $this->major;
    }

    /**
     * @param mixed $minor
     */
    public function setMinor($minor)
    {
        $this->minor = $minor;
    }

    /**
     * @return mixed
     */
    public function getMinor()
    {
        return $this->minor;
    }

    /**
     * @param mixed $mini
     */
    public function setMini($mini)
    {
        $this->mini = $mini;
    }

    /**
     * @return mixed
     */
    public function getMini()
    {
        return null === $this->mini ? 0 : $this->mini;
    }


    /**
     * @param mixed $cliParams
     */
    public function setCliParams($cliParams)
    {
        $this->cliParams = $cliParams;
    }

    public function build()
    {

        $this->setGradleProperty();
        $this->updateVersion();
        $this->updateGradlePropertyFile();
        $this->updateLmzVersion();
        $this->removeCachedFile();
    }

    protected function updateVersion()
    {
        $this->buildType = !empty($this->cliParams[1]) ? $this->cliParams[1] : 'minor';
        $major           = $this->getMajor();
        $minor           = $this->getMinor();
        $mini            = $this->getMini();
        switch ($this->buildType) {
            case 'major':
                $major++;
                $minor = 0;
                $mini  = 0;
                break;
            case 'mini':
                $mini++;
                break;
            case 'minor':
            default:
                $minor++;
                $mini = 0;
                break;

        }
        $this->setVersions($major . '.' . $minor . '.' . $mini);
    }

    protected function updateGradlePropertyFile()
    {
        $fp = fopen(self::GRADLE_PROPERTIES_FILE, 'w+');
        foreach ($this->getGradleProperty() as $k => $v) {
            fputs($fp, $k . '=' . $v . PHP_EOL);
        }

        fclose($fp);
        echo 'Application Version = ' . $this->getApplicationVersion();
    }

    protected function updateLmzVersion()
    {
        $lmzVersionFile = self::APP_CONFIG_PATH . '/' . self::APP_PROPERTIES_FILE;
        if (file_exists($lmzVersionFile)) {
            $fp = fopen($lmzVersionFile, 'w+');
            foreach ($this->getGradleProperty() as $k => $v) {
                if ($k === 'version') {
                    fputs($fp, $v);
                }
            }
            fclose($fp);
        }
    }

    protected function getApplicationVersion()
    {
        return $this->getMajor() . '.' . $this->getMinor() . '.' . $this->getMini();
    }

    protected function removeCachedFile()
    {
        $cachePath = self::APP_PATH . '/' . self::APP_CACHE_PATH;
        // Remove cached bootstrap
        if(null !== self::BOOTSTRAP_FILE) {
            $bootstrapFile = $cachePath . '/' . self::BOOTSTRAP_FILE;
            if (file_exists($bootstrapFile)) {
                unlink($bootstrapFile);
            }
        }

        // Remove Cached temlate files
        $cachedFilePath = $cachePath ;
        $cachedFiles    = scandir($cachedFilePath);
        foreach ($cachedFiles as $file) {
            if ($file != "." && $file != "..") {

                unlink($cachedFilePath . "/" . $file);
            }
        }

    }
}

$build = new builder($argv);