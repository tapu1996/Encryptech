var engine; //Variable to store instance of ScriptEngine Instance

function project_function() // script function for  Web Functional Tester project NewProject3
{
	var webtest = engine.createWebTest();
	webtest.setRecordThinkTime(true);
	webtest.setDefaultThinkTime(1);
	webtest.setSavePageImage(true);
	webtest.setUseSameTimeOut(false);
	webtest.setTreatTimeOutAsFailed(false);
	webtest.setTimeout(15);
	webtest.setRecordFlex(false);
	webtest.setIgnoreThinkTimeWhileReplaying(true);
	webtest.setSaveSuccessfulResponseDetails(false);
	webtest.setIterateTestForAllParameterCombinations(false);
	webtest.setNoOfIterations(1);
	webtest.setRunProjectOnMultipleMachines(false);
	webtest.setRunCrossBrowsers(false);
	webtest.setReplayLinkedProjects(true);
	webtest.addLinkProjectGroup('NewProject3', 'ActionGroup1', false, 1);
	webtest.addLinkProjectGroup('NewProject3', 'ActionGroup2', false, 1);
	var group = webtest.addActionGroup('ActionGroup1', IWebGroup.GROUP_HTTP);
	group.setStartingURL('http://localhost/Encryptech/index.php');
	group.setIgnored(false);
	group.setRepeatCount(1);
	group.setLaunchNewBrowser(true);
	group.setAuthenticationMechanism(IWebGroup.NO_AUTHENTICATION);
	group.setAuthenticationDomainName('');
	group.setUseUrlRewritingSessionManagement(false);
	group.setUseClientSSLAuthentication(false);
	group.setProxyWhileReplaying(false);
	var group = webtest.addActionGroup('ActionGroup2', IWebGroup.GROUP_HTTP);
	group.setStartingURL('http://localhost/Encryptech/index.php');
	group.setIgnored(false);
	group.setRepeatCount(1);
	group.setLaunchNewBrowser(true);
	group.setAuthenticationMechanism(IWebGroup.NO_AUTHENTICATION);
	group.setAuthenticationDomainName('');
	group.setUseUrlRewritingSessionManagement(false);
	group.setUseClientSSLAuthentication(false);
	group.setProxyWhileReplaying(false);
}

function global_validation(url)
{
}

function group_1() // script function for ActionGroup1
{
	executeBrowser_5();
	executeEvent_6();
}

function executeBrowser_5() // script function for Browser_1
{
	var browser = engine.createBrowser(5, 'Browser_1', 'http', 'localhost', 80, '/Encryptech/index.php');
	browser.setBrowserDescription('');
	browser.setThinkTime(1);
	browser.setTimeout(30);
	browser.setBreakPoint(false);
	browser.setIgnored(false);
	var successful = engine.executeBrowser(browser);
	if (!successful)
	{
		log('Browser Failed');
	}
	else
	{
		//log('Browser is Successful');
	}
	engine.release();

}

function executeEvent_6() // script function for close on WebBrowserElement 
{
	var element = engine.createWebBrowserElement(6, 1);
	element.setIgnored(false);
	element.setThinkTime(1);
	element.setTimeout(30);
	element.setExactMatchForAttributesComparision(false);
	element.setBreakPoint(false);
	element.setTitle('close on WebBrowserElement ');
	element.setImagePath('');
	element.close();
	engine.release();

}

function group_2() // script function for ActionGroup2
{
	executeBrowser_3();
	executeEvent_4();
}

function executeBrowser_3() // script function for Browser_2
{
	var browser = engine.createBrowser(3, 'Browser_2', 'http', 'localhost', 80, '/Encryptech/index.php');
	browser.setBrowserDescription('');
	browser.setThinkTime(1);
	browser.setTimeout(30);
	browser.setBreakPoint(false);
	browser.setIgnored(false);
	var successful = engine.executeBrowser(browser);
	if (!successful)
	{
		log('Browser Failed');
	}
	else
	{
		//log('Browser is Successful');
	}
	engine.release();

}

function executeEvent_4() // script function for close on WebBrowserElement 
{
	var element = engine.createWebBrowserElement(4, 1);
	element.setIgnored(false);
	element.setThinkTime(1);
	element.setTimeout(30);
	element.setExactMatchForAttributesComparision(false);
	element.setBreakPoint(false);
	element.setTitle('close on WebBrowserElement ');
	element.setImagePath('');
	element.close();
	engine.release();

}
