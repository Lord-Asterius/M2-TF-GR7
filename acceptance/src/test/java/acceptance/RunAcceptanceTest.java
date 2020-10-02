package acceptance;

import cucumber.api.CucumberOptions;
import cucumber.api.junit.Cucumber;
import org.junit.runner.RunWith;


@RunWith(Cucumber.class)
@CucumberOptions(plugin = {
                            "pretty",  "html:target/test-report",
                            "json:target/test-report/acceptance.json",
                            "junit:target/test-report/acceptance.xml",
                           },
                 features = "src/test/resources")
public class RunAcceptanceTest
{
}
