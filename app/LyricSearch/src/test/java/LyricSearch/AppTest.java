package LyricSearch;

import junit.framework.Test;
import junit.framework.TestCase;
import junit.framework.TestSuite;

import java.io.IOException;

/**
 * Unit test for simple App.
 */
public class AppTest 
    extends TestCase
{
    /**
     * Create the test case
     *
     * @param testName name of the test case
     */
    public AppTest( String testName )
    {
        super( testName );
    }

    /**
     * @return the suite of tests being tested
     */
    public static Test suite()
    {
        return new TestSuite( AppTest.class );
    }


    /**
     * Rigourous Test :-)
     */
    public void testApp() throws IOException {
        assertEquals("test name cleanup", "回忆里的疯狂", DBTalker.nameCleanUp("光良 - 01.回忆里的疯狂.mp3") );
        assertEquals("test name cleanup", "Angel", DBTalker.nameCleanUp("Angel（天使）.mp3") );

        Lyricer lrc = new BaiduLyricer();
        System.out.println(lrc.findLrcLyric("品冠", "疼你的责任"));
        System.out.println(lrc.findLrcLyric("", "泡沫"));
        lrc = new Lrc123Lyricer();
        System.out.println(lrc.findLrcLyric("品冠", "疼你的责任"));
    }
}
