package acceptance;

import cucumber.api.java.en.And;
import cucumber.api.java.en.Given;
import cucumber.api.java.en.Then;
import cucumber.api.java.en.When;
import org.openqa.selenium.By;
import org.openqa.selenium.htmlunit.HtmlUnitDriver;

import static org.hamcrest.CoreMatchers.is;
import static org.junit.Assert.assertThat;


public class FeatureSubscribeStudent {

    private HtmlUnitDriver m_driver;

    @Given("^l'administrateur est maintenant connecté$")
    public void AdministrativeStaff() {
        m_driver = new HtmlUnitDriver();
        Utils.connectToSite(m_driver);
        Utils.loginAdmin(m_driver);
        m_driver.findElement(By.linkText("Administration")).click();
    }


    @And("^le module d'enseignement impacté existe$")
    public void ModuleIsExist() {
        m_driver.findElement(By.linkText("Gestion des modules")).click();
        assertThat(m_driver.findElement(By.cssSelector(".list-group-item:nth-child(1) > a")).getText(), is("test pas vraiment fonctionnelle"));
    }

    @And("^l'étudiant à ajouter existe$")
    public void StudentExist(){
        m_driver.findElement(By.linkText("test pas vraiment fonctionnelle")).click();
        m_driver.findElement(By.linkText("Gerer l'inscription des Etudiants")).click();
        //assertThat(m_driver.findElement(By.cssSelector(".list-group-item:nth-child(2) > .custom-control")).getText(), is("Jean Hotine"));
    }

    @When ("^l'administrateur tente d'ajouter un étudiant au module d'enseignement$")
    public void AdminAddStudent() {
        m_driver.findElement(By.cssSelector(".list-group-item:nth-child(2) .custom-control-label")).click();
        m_driver.findElement(By.cssSelector(".btn")).click();
    }


    @Then("^l'étudiant est ajouté au module avec succès$")
    public void StudentIsAdded(){
        m_driver.findElement(By.linkText("Gerer l\'inscription des Etudiants")).click();
        assertThat(m_driver.findElement(By.cssSelector(".list-group-item:nth-child(2) > .custom-control")).getText(), is("Guy Hotine"));
    }

}
