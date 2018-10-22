//
//  AppDelegate.swift
//  CapstoneApplication
//
//  Copyright © 2018 ArraysAtOne. All rights reserved.
//

//Imports
import UIKit
import WebKit

class ApplicationViewController: UIViewController, WKUIDelegate, WKNavigationDelegate{

    //Outlets
    @IBOutlet var webView: WKWebView?
    
    //ViewDidLoad
    override func viewDidLoad() {
        super.viewDidLoad()
        
        //Set Destination URL Safely
        guard let applicationURL = URL(string: "https://harquaim.dev.fast.sheridanc.on.ca/Capstone/") else{
            return
        }
        
        //Load Web Application
        let applicationRequest = URLRequest(url: applicationURL)
        webView?.load(applicationRequest)
    }
    
    //Status Bar Change to Accomodate for Stylizations
    override var preferredStatusBarStyle: UIStatusBarStyle {
        return .lightContent
    }
    
    //Prepare Webkit View to Access Web Application
    override func loadView() {
        let webConfiguration = WKWebViewConfiguration()
        webView = WKWebView(frame: .zero, configuration: webConfiguration)
        webView?.uiDelegate = self
        view = webView
    }
}
