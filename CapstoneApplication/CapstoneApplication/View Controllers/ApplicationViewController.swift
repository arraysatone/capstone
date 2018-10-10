//
//  AppDelegate.swift
//  CapstoneApplication
//
//  Copyright © 2018 ArraysAtOne. All rights reserved.
//

import UIKit
import WebKit

class ApplicationViewController: UIViewController, WKUIDelegate {

    var applicationWebView: WKWebView?
    var applicationURL = URL(string: "https://harquaim.dev.fast.sheridanc.on.ca/Capstone")
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        if let applicationURL = self.applicationURL{
            let applicationRequest = URLRequest(url: applicationURL)
            applicationWebView?.load(applicationRequest)
        }
    }
    
    override var preferredStatusBarStyle: UIStatusBarStyle {
        return .lightContent
    }
    
    override func loadView() {
        let webConfiguration = WKWebViewConfiguration()
        applicationWebView = WKWebView(frame: .zero, configuration: webConfiguration)
        applicationWebView?.uiDelegate = self
        view = applicationWebView
    }
    
}
